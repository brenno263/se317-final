<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    const THUMB_HEIGHT = 400;
    const THUMB_WIDTH = 400;

    protected $fillable = [
        'title',
        'description',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function asset(bool $thumbnail = false) {
        return asset('storage/'.$this->build_path($thumbnail));
    }

    public function thumb() {
        return $this->asset(true);
    }

    public function storage_path(bool $thumbnail = false) {
        return 'public/' . $this->build_path($thumbnail);
    }

    public function build_path(bool $thumbnail = false) {
        return Image::buildPath($this->hash, $thumbnail);
    }

    public static function buildPath(string $imageHash, bool $thumbnail = false) {
        return 'images/' . $imageHash  . ($thumbnail ? '_thumb.jpg' : '.png');
    }
}
