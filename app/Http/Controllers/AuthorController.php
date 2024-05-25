<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\StorePostAuthor;
use App\Http\Requests\Author\UpdatePutAuthor;
use App\Repositories\AuthorRepository;
use App\Traits\ApiResponse;

class AuthorController extends Controller
{
    use ApiResponse;
    private AuthorRepository $authorRepository;
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index()
    {
        return $this->successResponse($this->authorRepository->list());
    }
    public function store(StorePostAuthor $request)
    {
        return $this->successResponse($this->authorRepository->create($request->all()));
    }

    public function show($id)
    {
        return $this->successResponse($this->authorRepository->getOrFail($id));
    }

    public function update($id, UpdatePutAuthor $request)
    {
        $author = $this->authorRepository->getOrFail($id);
        $author->fill($request->all());

        return $this->successResponse($this->authorRepository->save($author));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $author = $this->authorRepository->getOrFail($id);

        return $this->successResponse($this->authorRepository->delete($author));

    }
}
