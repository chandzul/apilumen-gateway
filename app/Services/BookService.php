<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService
{
  use ConsumesExternalService;

  /**
   * The base uri to be used to consume the books service
   *
   * @var String
   */
  public $baseUri;

  /**
   * The secret to be used to consume the books service
   *
   * @var String
   */
  public $secret;

  public function __construct()
  {
    $this->baseUri = config('services.books.base_uri');
    $this->secret = config('services.books.secret');
  }

  public function obtainBooks()
  {
    return $this->performRequest('GET', '/books');
  }

  public function createBooks($data)
  {
    return $this->performRequest('POST', '/books', $data);
  }

  public function obtainBook($book)
  {
    return $this->performRequest('GET', "/books/{$book}");
  }

  public function editBook($data, $book)
  {
    return $this->performRequest('PUT', "/books/{$book}", $data);
  }

  public function deleteBook($book)
  {
    return $this->performRequest('DELETE', "/books/{$book}");
  }
}