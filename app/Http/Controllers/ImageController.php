<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Imagick;
use ImagickException;
use ImagickPixel;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    /**
     * This method is run on construction.
     */
    public function __construct()
    {
        // Add the auth middleware to specified actions, requiring the user to be logged in, and redirecting to the login page otherwise.
        $this->middleware('auth', ['except' => ['publicIndex', 'index', 'show']]);
    }

    /**
     * Display a listing of images for a specific user.
     * Only show public ones if we're not the owning user.
     *
     * @param User $user
     * @return View
     */
    public function index(User $user)
    {
        $images = $user->images();
        if(!Auth::user() || Auth::user()->id != $user->id) {
            $images = $images->where('public', true);
        }
        $paginator = $images->orderByDesc('created_at')->paginate(8);
        return view('images.index', ['user' => $user, 'paginator' => $paginator]);
    }

    /**
     * Display a listing of public images for all users
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function publicIndex()
    {
        $paginator = Image::query()->where('public', true)->paginate(8);
        return view('images.public-index', ['paginator' => $paginator]);
    }

    /**
     * Show the form for creating a new image.
     *
     * @return View
     */
    public function create(User $user)
    {
        return view('images.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'nullable', 'max: 4096'],
            'public' => ['nullable'],
            'image' => [
                'required',
                File::image()
                    ->max(8 * 1024) //limit to 8 MiB
                    ->dimensions(
                        Rule::dimensions()->maxWidth(10_000)->maxHeight(10_000)
                    ),
            ],
        ]);

        try {
            $imageHash = $this->uploadImage($validated['image']);
        } catch (ImagickException $_) {
            return back()->withErrors('Failed to save image. Try again later or contact an administrator');
        }

        $image = new Image();
        $image->title = $validated['title'];
        $image->description = $validated['description'] ?: "No description...";
        $image->public = isset($validated['public']) && $validated['public'] == 'on';
        $image->hash = $imageHash;

        Auth::user()->images()->save($image);

        return redirect()->route('users.images.index', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param Image $image
     * @return View
     * @throws AuthorizationException
     */
    public function show(User $user, Image $image)
    {
        //Authorization requires the user to be logged in. Only authorize if it's not a public image.
        if(!$image->public) $this->authorize('view', $image);

        return view('images.show', [
            'user' => $user,
            'image' => $image,
        ]);
    }

    /**
     * Show the form for editing the specified image.
     *
     * @param User $user
     * @param Image $image
     * @return View
     */
    public function edit(User $user, Image $image)
    {
        return view('images.edit', ['user' => $user, 'image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @param Image $image
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, User $user, Image $image)
    {
        $this->authorize('update', $image);

        $validated = $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'nullable', 'max: 4096'],
            'public' => ['nullable'],
        ]);

        $image->title = $validated['title'];
        $image->description = $validated['description'] ?: "No description...";
        $image->public = isset($validated['public']) && $validated['public'] == 'on';

        $image->save();

        return redirect()->route('users.images.show', ['user' => $user, 'image' => $image]);
    }

    /**
     * Show a form confirming whether the user really wants to delete an image.
     *
     * @param User $user
     * @param Image $image
     * @return View
     */
    public function destroyConfirm(User $user, Image $image)
    {
        return view('images.destroy-confirm', ['user' => $user, 'image' => $image]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param User $user
     * @param Image $image
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Request $request, User $user, Image $image)
    {
        $this->authorize('delete', $image);

        $request->validate([
            'obliterate' => 'accepted',
        ]);

        //Since we store images by hashes, we can store duplicate images in the same file.
        //If there's another image out there with the same hash, don't delete these files - they're still being used.
        //TODO: put this in a hook so it happens automatically on resource deletion.
        if (Image::query()->where('hash', $image->hash)->where('id', '!=', $image->id)->doesntExist()) {
            $this->deleteImage($image);
        }

        $image->delete();

        return redirect()->route('users.images.index', ['user' => $user]);
    }

    /**
     * A helper method which processes and stores an image, given the initial uploaded file.
     *
     * @param UploadedFile $upload
     * @return string hash of the image, which should be stored in the database.
     * @throws ImagickException
     */
    public function uploadImage(UploadedFile $upload): string
    {
        $uploadPath = $upload->getRealPath();
        $imageHash = md5_file($uploadPath);

        $originalPath = Image::buildPath($imageHash, false);
        $thumbPath = Image::buildPath($imageHash, true);
        $storagePath = Storage::path('public');
        if (!is_dir($storagePath)) {
            mkdir(dirname($storagePath), 0777, true);
        }

        $imagick = new Imagick();

        $imagick->readImage($uploadPath);
        $imagick->setImageBackgroundColor(new ImagickPixel('black'));
        $imagick->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
        $imagick->setImageFormat('jpg');
        Storage::put('public/' . $originalPath, $imagick->getImageBlob());

        $imagick->setCompressionQuality(70);
        $imagick->resizeImage(Image::THUMB_WIDTH, Image::THUMB_HEIGHT, Imagick::FILTER_LANCZOS, 1, true);
        $geometry = $imagick->getImageGeometry();
        $width = $geometry['width'];
        $height = $geometry['height'];
        $thumb_width = Image::THUMB_WIDTH;
        $thumb_height = Image::THUMB_HEIGHT;
        $thumb_x = ($width - $thumb_width) / 2;
        $thumb_y = ($height - $thumb_height) / 2;
        $imagick->extentImage($thumb_width, $thumb_height, $thumb_x, $thumb_y);
        Storage::put('public/' . $thumbPath, $imagick->getImageBlob());

        $imagick->destroy();

        return $imageHash;
    }

    /**
     * A helper method to delete an image from storage.
     *
     * @param Image $image
     * @return void
     */
    public function deleteImage(Image $image)
    {
        $originalPath = $image->storage_path();
        $thumbPath = $image->storage_path(true);
        Storage::delete([
            $originalPath,
            $thumbPath,
        ]);
    }
}
