<?php

namespace App\Http\Controllers;

use App\Models\Image;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create', ['user' => Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'max: 4096'],
            'public' => ['required'],
            'image' => [
                'required',
                File::image()
                    ->max(8 * 1024) //limit to 8 MiB
                    ->dimensions(
                        Rule::dimensions()->maxWidth(2048)->maxHeight(2048)
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
        $image->description = $validated['description'];
        $image->public = $validated['public'] == 'on';
        $image->hash = $imageHash;

        Auth::user()->images()->save($image);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Image $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Image $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }

    /**
     * @param UploadedFile $upload
     * @return string hash of the image, which should be stored in the database.
     * @throws \ImagickException
     */
    public function uploadImage(UploadedFile $upload): string
    {
        $uploadPath = $upload->getRealPath();
        $imageHash = md5_file($uploadPath);

        $originalPath = Image::buildPath($imageHash, Auth::user()->id, false);
        $thumbPath = Image::buildPath($imageHash, Auth::user()->id, true);
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
}
