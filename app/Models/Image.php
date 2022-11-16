<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function asset(bool $thumbnail = false) {
        return asset('storage/'.Image::buildPath($this->hash, $this->user_id, $thumbnail));
    }

    public function thumb() {
        return $this->asset(true);
    }

    public static function buildPath(string $imageHash, int $userId, bool $thumbnail = false) {
        $userHash = substr(md5($userId), 16);
        return 'images/' . $userHash . '/' . $imageHash  . ($thumbnail ? '_thumb.jpg' : '.png');
    }
}
