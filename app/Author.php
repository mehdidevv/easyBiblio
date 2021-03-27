<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['first_name', 'last_name', 'birth_date', 'nationality'];
    public function Books()
    {
        return $this->hasMany(Book::class);
    }
}
