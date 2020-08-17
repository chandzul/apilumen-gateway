<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService
{
  use ConsumesExternalService;

  /**
   * The base uri to be used to consume the authors service
   *
   * @var String
   */
  public $baseUri;

  /**
   * The secret to be used to consume the authors service
   *
   * @var String
   */
  public $secret;

  public function __construct()
  {
    $this->baseUri = config('services.authors.base_uri');
    $this->secret = config('services.authors.secret');
  }

  /**
   * [obtainAuthors description]
   *
   * @return  [type]  [return description]
   */
  public function obtainAuthors()
  {
    return $this->performRequest('GET', '/authors');
  }

  /**
   * [createAuthors description]
   *
   * @param   [type]  $data  [$data description]
   *
   * @return  [type]         [return description]
   */
  public function createAuthors($data)
  {
    return $this->performRequest('POST', '/authors', $data);
  }

  /**
   * Get a single author from the authors service
   *
   * @param   number  $author  id on the db
   *
   * @return  string           json data
   */
  public function obtainAuthor($author)
  {
    return $this->performRequest('GET', "/authors/{$author}");
  }

  /**
   * [editAuthor description]
   *
   * @param   [type]  $data    [$data description]
   * @param   [type]  $author  [$author description]
   *
   * @return  [type]           [return description]
   */
  public function editAuthor($data, $author)
  {
    return $this->performRequest('PUT', "/authors/{$author}", $data);
  }

  /**
   * Remove a single author from the authors service
   *
   * @param   number  $author  id
   *
   * @return  json           data removed
   */
  public function deleteAuthor($author)
  {
    return $this->performRequest('DELETE', "/authors/{$author}");
  }
}