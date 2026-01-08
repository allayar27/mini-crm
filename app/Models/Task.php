<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'title',
        'due_at',
        'is_done'
    ];

    protected $casts = [
        'due_at' => 'datetime',
        'is_done' => 'boolean'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }
}
