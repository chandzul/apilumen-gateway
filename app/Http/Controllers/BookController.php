<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Services\BookService;
use App\Services\AuthorService;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the book service
     *
     * @var BookService
     */
    public $bookService;

    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    public function store(Request $request)
    {
        $this->authorService->obtainAuthor($request->author_id);

        return $this->successResponse($this->bookService->createBooks($request->all()), Response::HTTP_CREATED);
    }

    public function show($book)
    {
        return $this->successResponse($this->bookService->obtainBook($book));
    }

    public function update(Request $request, $book)
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $book));
    }

    public function destroy($book)
    {
        return $this->successResponse($this->bookService->deleteBook($book));
    }
}
