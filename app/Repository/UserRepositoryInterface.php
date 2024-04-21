<?php
namespace App\Repository;

interface UserRepositoryInterface {

   public function GetAllUsers();

   public function Create();

   public function StoreUser($request);

   public function EditUser($user);
   
   public function UpdateUser($request,$user);

   public function DeleteUser($user);
}