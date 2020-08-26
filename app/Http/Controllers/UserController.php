<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * [index description]
     *
     * @return  [type]  [return description]
     */
    public function index() 
    {
      $users = User::all();

      // return $this->successResponse($users);
      return $this->validResponse($users);
    }

    /**
     * [store description]
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [type]             [return description]
     */
    public function store(Request $request)
    {
      $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
      ];

      $this->validate($request, $rules);

      $fields = $request->all();
      $fields['password'] = Hash::make($request->password);

      $user = User::create($fields);

      return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * [show description]
     *
     * @param   [type]  $user  [$user description]
     *
     * @return  [type]           [return description]
     */
    public function show($user)
    {
      $user = User::findOrFail($user);

      return $this->successResponse($user);
    }

    /**
     * [update description] -> se usa x-www-form-urlencode
     *
     * @param   Request  $request  [$request description]
     * @param   [type]   $user   [$user description]
     *
     * @return  [type]             [return description]
     */
    public function update(Request $request, $user)
    {
      $rules = [
        'name' => 'max:255',
        'email' => 'email|unique:users,email,' . $user,
        'password' => 'min:8|confirmed',
      ];

      $this->validate($request, $rules);

      $user = User::findOrFail($user);

      $user->fill($request->all());

      if($request->has('password')) {
        $user->password = Hash::make($request->password);
      }

      if($user->isClean()) {
        return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY); // mandaron algo igual o nada
      }

      $user->save();

      return $this->successResponse($user);   
    }

    /**
     * [destroy a exist user]
     *
     * @param   [type]  $user  [$user description]
     *
     * @return  [type]           [return description]
     */
    public function destroy($user)
    {
      $user = User::findOrFail($user);

      $user->delete();

      return $this->successResponse($user);
    }

    /**
     * Identify the current user
     * @return Illiminate/
     */
    public function me(Request $request)
    {
      return $this->validResponse($request->user());
    }
}
