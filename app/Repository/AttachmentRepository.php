<?php

namespace App\Repository;

use App\Models\Attachment;

class AttachmentRepository implements AttachmentRepositoryInterface {

    public function StoreAttachment($request)
    {
        Attachment::create($request->only('file','task_id'));
        return redirect()->back();
    }
    public function Delete($attachment)
    {
        $attachment->delete();
        return redirect()->back();

    }

}