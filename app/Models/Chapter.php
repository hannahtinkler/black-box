<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $guarded = [];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
