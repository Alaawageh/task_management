<?php
namespace App\Repository;

interface AttachmentRepositoryInterface {

    public function StoreAttachment($request);

    public function Delete($attachment);
}