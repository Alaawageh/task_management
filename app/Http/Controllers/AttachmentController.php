<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attachment\StoreAttachmentRequest;
use App\Models\Attachment;
use App\Repository\AttachmentRepositoryInterface;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    protected $Attachment;

    public function __construct(AttachmentRepositoryInterface $Attachment)
    {
        $this->Attachment = $Attachment;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreAttachmentRequest $request)
    {
        return $this->Attachment->StoreAttachment($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        return $this->Attachment->Delete($attachment);

    }
} 
