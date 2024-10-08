<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function scopeActiveEntries($query){
        return $query->where([
            'status' => 'active',
            'is_approved' => 'approved',
        ]);
    }


    public function scopeWithLocalize($query){
        return $query->where([
            'language'=> getLanguage(),
        ]);
    }

    protected $fillable =[
        'language',
        'category_id',
        'author_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'meta_title',
        'meta_description',
        'is_breaking_news',
        'show_at_slider',
        'show_at_popular',
        'is_approved',
        'views',
        'status',
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'author_id');
    }


}
