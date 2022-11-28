<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    /** @var int Defines the height of thumbnail images */
    const THUMB_HEIGHT = 400;
    /** @var int Defines the width of thumbnail images */
    const THUMB_WIDTH = 400;

    /** @var string[] These fields can be bulk-filled with helper methods, as opposed to explicit assignment. */
    protected $fillable = [
        'title',
        'description',
    ];

    /**
     * Define relationship to owning user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Return a path to the associated asset, for embedding in <img> tags, etc.
     *
     * @param bool $thumbnail
     * @return string
     */
    public function asset(bool $thumbnail = false) {
        return asset('storage/'.$this->build_path($thumbnail));
    }

    /**
     * Return a path to the associated thumbnail asset, for embedding in <img> tags, etc.
     *
     * @return string
     */
    public function thumb() {
        return $this->asset(true);
    }

    /**
     * Get the file path to our image from the storage/app directory. For use with the Storage facade.
     *
     * @param bool $thumbnail
     * @return string
     */
    public function storage_path(bool $thumbnail = false) {
        return 'public/' . $this->build_path($thumbnail);
    }

    /**
     * An associated method, building the image's path using its stored hash value.
     *
     * @param bool $thumbnail
     * @return string
     */
    public function build_path(bool $thumbnail = false) {
        return Image::buildPath($this->hash, $thumbnail);
    }

    /**
     * A static method, building an image's path using only its hash.
     *
     * @param string $imageHash
     * @param bool $thumbnail
     * @return string
     */
    public static function buildPath(string $imageHash, bool $thumbnail = false) {
        return 'images/' . $imageHash  . ($thumbnail ? '_thumb.jpg' : '.jpg');
    }
}
