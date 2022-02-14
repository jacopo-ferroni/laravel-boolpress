<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'cover',
    ];

    // Relation with categories
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // Relation with tags
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

}