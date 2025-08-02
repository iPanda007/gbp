<?php

namespace App\Models;

use app\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'featured_image',
        'content',
        'category',
        'tag',
        'embed_video',
        'status',
        'popularity'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
