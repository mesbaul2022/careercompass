<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_circular_id', 'user_id', 'phone', 'highest_education', 
        'experience_years', 'cv_path', 'cover_letter'
    ];

    public function job()
    {
        return $this->belongsTo(JobCircular::class, 'job_circular_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}