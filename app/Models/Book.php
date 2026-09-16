<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'pages',
        'isbn',
        'category',
        'synopsis',
        'stock',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'pages' => 'integer',
        'stock' => 'integer',
    ];
}
