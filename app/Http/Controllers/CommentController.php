<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use App\Repository\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $Comment;

    public function __construct(CommentRepositoryInterface $Comment)
    {
        $this->Comment = $Comment;
    }

    public function index()
    {
        
    }

    
    public function create()
    {
        //
    }

    public function store(StoreCommentRequest $request)
    {
        return $this->Comment->StoreComment($request);
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }
    
    public function destroy(Comment $comment)
    {
        return $this->Comment->Delete($comment);
    }
}
