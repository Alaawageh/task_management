<?php
namespace App\Repository;

interface CommentRepositoryInterface {

    public function StoreComment($request);

    public function Delete($comment);


}