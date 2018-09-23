<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasSlug;

    protected $guarded = [];

    protected $with = [
        'chapter',
    ];

    public function permalink()
    {
        return sprintf(
            '/p/%s/%s/%s',
            $this->chapter->category->slug,
            $this->chapter->slug,
            $this->slug
        );
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function category()
    {
        return $this->chapter->belongsTo(Category::class);
    }
}
