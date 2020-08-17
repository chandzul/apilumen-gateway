<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the author service
     *
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthors($request->all()), Response::HTTP_CREATED);
    }

    public function show($author)
    {
        return $this->successResponse($this->authorService->obtainAuthor($author));
    }

    public function update(Request $request, $author)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }

    public function destroy($author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }
}
