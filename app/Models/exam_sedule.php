<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exam_sedule extends Model
{
    protected $fillable = [
        'title',
        'description',
        'exam_schedule',
        'duration',
        'created_by',
        'exam_type',
        'status'
    ];

    /**
     * Get the user (admin) who created the exam.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
