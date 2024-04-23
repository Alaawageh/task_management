<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository implements UserRepositoryInterface {

    public function GetAllUsers()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }
    public function Create() 
    {
        // $roles = Cache::remember('roles',function() {
            $roles = Role::latest()->get();

        // });
        return view('users.create', compact('roles'));
    }
    public function StoreUser($request)
    {
        DB::beginTransaction();
        try{
            $user = User::create(array_merge($request->only('name','email'), [
                'password' => Hash::make($request->password)
            ]));

            $user->assignRole($request->input('role'));
            DB::commit();
            return redirect()->route('users.index');

        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        } 
    }
    public function EditUser($user)
    {
        $userRole = $user->roles?->pluck('name')->toArray();
        $roles = Role::latest()->get();
        return view('users.edit',compact('user','userRole','roles'));
    }
    public function UpdateUser($request,$user)
    {
        DB::beginTransaction();
        try{
            $user->update(array_merge($request->only('name','email'), [
                'password' => Hash::make($request->password)
            ]));

            $user->syncRoles($request->role);
            DB::commit();

            return redirect()->route('users.index');
        }catch (\Exception $e) {

            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function DeleteUser($user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

}