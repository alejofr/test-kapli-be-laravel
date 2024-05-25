<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public static int $book_id;
    public static int $author_id;
    public static string $title;
    public static int $stars;
    public static string $overview;

    protected $primaryKey = 'book_id';
    protected $fillable = [
        'author_id',
        'title',
        'stars',
        'overview'
    ];

    protected $table = 'books';

    public function author(){ return $this->belongsTo('App\Models\Author'); }

    
}
