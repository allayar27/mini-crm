<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'status',
        'note',
        'assigned_to'
    ];

    protected  $casts = [
        'status' => LeadStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


    public function getStatusLabelAttribute(): ?string
    {
        return match ($this->status) {
            LeadStatus::New => ucfirst(strtolower($this->status->getLabel())),
            LeadStatus::InProgress => ucfirst(strtolower($this->status->getLabel())),
            LeadStatus::Done => ucfirst(strtolower($this->status->getLabel())),
        };
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }
}
