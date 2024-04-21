<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'priority', 
        'start_date', 'end_date', 'status',
        'created_by', 
    ];

    protected $casts = [
        'end_date' => 'datetime',
        'start_date' => 'datetime'
    ];
    
    public function createdBy():BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function attachments():HasMany
    {
        return $this->hasMany(Attachment::class);
    }
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function scopeTaskStatus($query)
    {
        return $query->where('status','!=',3);
    }
    public function scopeTaskDeadline($query)
    {
        return $query->whereDate('end_date', '=', now()->toDateString());
    }
    public function scopeTaskReminder($query)
    {
        return $query->where('status','!=',3)->whereDate('end_date','>','start_date');
    }
}
