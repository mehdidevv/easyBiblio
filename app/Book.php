<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['author_id', 'category_id', 'title', 'isbn', 'nb_pages', 'year', 'description', 'availability', 'cover'];
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }
}
