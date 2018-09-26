<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Model;

class PageDraft extends Model
{
    protected $guarded = [];

    protected $casts = [
        'has_resources' => 'boolean',
    ];

    protected $with = [
        'chapter',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function category()
    {
        return $this->chapter->belongsTo(Category::class);
    }
}
