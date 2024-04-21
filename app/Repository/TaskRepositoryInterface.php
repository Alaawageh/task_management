<?php
namespace App\Repository;

interface TaskRepositoryInterface {

    public function GetAllTasks();

    public function GetAllUsers();

    public function StoreTask($request);

    public function UpdateTask($request,$task);

    public function DeleteTask($task);

    public function SaveStatus($request,$task);

    public function ShowDetails($taskID);

    public function Search($request);

    public function TaskComplected();

}