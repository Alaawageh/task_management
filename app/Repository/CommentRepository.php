<?php

namespace App\Repository;

class CommentRepository implements CommentRepositoryInterface {

    
    public function StoreComment($request)
    {
        try{
            auth()->user()->comments()->create($request->safe()->all());
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function Delete($comment)
    {
        $comment->delete();
        return redirect()->back();

    }
   
   

}