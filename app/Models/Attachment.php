<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'file'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function setFileAttribute ($file)
    {
        $newFileName = uniqid() . '_' . 'file' . '.' . $file->extension();
        $file->move(public_path('task/attachments') , $newFileName);
        return $this->attributes['file'] ='/'.'task/attachments'.'/' . $newFileName;
    }
}
