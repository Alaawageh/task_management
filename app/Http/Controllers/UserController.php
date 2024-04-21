<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $User;

    public function __construct(UserRepositoryInterface $User)
    {
        $this->User = $User;
    }

    public function index()
    {
        return $this->User->GetAllUsers();
        
    }
    public function create()
    {
        return $this->User->Create();
    }
    public function store(StoreUserRequest $request)
    {
        return $this->User->StoreUser($request);
    }
    public function show(User $user)
    {

    }
    public function edit(User $user)
    {
        return $this->User->EditUser($user);
    }
    public function update(Request $request, User $user)
    {
        return $this->User->UpdateUser($request,$user);
    }
    public function destroy(User $user) 
    {
        return $this->User->DeleteUser($user);
    }
}
