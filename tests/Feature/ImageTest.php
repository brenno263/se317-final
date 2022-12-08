<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ImageTest extends TestCase
{

    protected User $user;
    protected array $imageData = [
        'title' => 'example title',
        'description' => 'lorem ipsum',
        'public' => 'on',
    ];
    protected $userData = [
        'name' => 'Test User McGee',
        'email' => 'test.user.mcgee@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    private function create_user(): User {
        $user = User::query()
            ->where('name', $this->userData['name'])
            ->where('email', $this->userData['email'])
            ->first();
        if(isset($user)) {
            $user->delete();
        }

        $user = new User();
        $user->name = $this->userData['name'];
        $user->email = $this->userData['email'];
        $user->password = Hash::make($this->userData['password']);
        $user->save();

        return $user;
    }

    private function clear_images(User $user) {
        /** @var Image $image */
        $user->images()->each(function (Image $image) {
            $image->delete();
        });
    }


    /**
     * Test uploading an image.
     *
     * @return void
     */
    public function test_upload()
    {
        $user = $this->create_user();
        $this->clear_images($user);
        $imageFile = UploadedFile::fake()->image('fake-image.png');
        $res = $this
            ->actingAs($user)
            ->post(
                route('users.images.store', ['user' => $user]),
                array_merge($this->imageData, ['image' => $imageFile]),
            );

        $res->assertStatus(302);
        $res->assertRedirect();
        
        $this->assertTrue(
            Image::query()
                ->where('title', $this->imageData['title'])
                ->where('description', $this->imageData['description'])
                ->where('hash', md5_file($imageFile->getRealPath()))
                ->exists()
        );
    }
}
