<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public static int $author_id;
    public static string $name;
    public static int    $age;
    public static string $bibliography;

    protected $primaryKey = 'author_id';
    protected $fillable = [
        'name',
        'age',
        'bibliography'
    ];

    protected $table = 'authors';

    public function books() { return $this->hasMany('App\Models\Book', 'author_id', 'author_id'); }
    
}
