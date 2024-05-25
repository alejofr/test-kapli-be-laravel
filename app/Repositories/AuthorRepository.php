<?php 

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository  extends Repository{

    public function __construct(Author $author)
    {
        parent::__construct($author);
    }

}