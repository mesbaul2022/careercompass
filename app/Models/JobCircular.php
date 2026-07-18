<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. ADD THIS IMPORT
use Illuminate\Support\Str;

class JobCircular extends Model
{
    use HasFactory; 
    protected $fillable = [
        'title', 'slug', 'company_name', 'company_logo', 'category', 'location', 
        'experience', 'salary', 'description', 'requirements', 'responsibilities', 
        'benefits', 'image', 'attachment', 'deadline', 'user_id',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_jobs', 'job_circular_id', 'user_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    protected static function booted()
    {
        static::creating(function ($job) {
            $job->slug = Str::slug($job->title) . '-' . Str::random(5);
        });
    }

    public function isExpired(): bool
    {
        return $this->deadline->isPast();
    }

    // Turns "Govt Bank" into "govt-bank" so we can key it to a CSS colour class (cat-govt-bank)
    public function categorySlug(): string
    {
        return Str::slug($this->category);
    }

    // Used to show "3 days left" style urgency chips on job cards
    public function daysLeft(): int
    {
        return (int) now()->startOfDay()->diffInDays($this->deadline, false);
    }
}
