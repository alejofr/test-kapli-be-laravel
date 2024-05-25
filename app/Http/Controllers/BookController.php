<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\IndexGetBook;
use App\Http\Requests\Book\StorePostBook;
use App\Http\Requests\Book\UpdatePutBook;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiResponse;
    private AuthorRepository $authorRepository;
    private BookRepository $bookRepository;
    public function __construct(AuthorRepository $authorRepository, BookRepository $bookRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexGetBook $request)
    {
        $author = $this->authorRepository->getOrFail($request->author_id);

        return $this->successResponse($author->books()->get()->toArray());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostBook $request)
    {
        $this->authorRepository->getOrFail($request->author_id);

        return $this->successResponse($this->bookRepository->create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->successResponse($this->bookRepository->getOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdatePutBook $request)
    {
        $book = $this->bookRepository->getOrFail($id);

        if( !empty($request->author_id) && $request->author_id !== $book->author_id ){
            $this->authorRepository->getOrFail($request->author_id);
        }

        $book = $book->fill($request->all());

        return $this->successResponse($this->bookRepository->save($book));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $book = $this->bookRepository->getOrFail($id);

        return $this->successResponse($this->bookRepository->delete($book));

    }
}
