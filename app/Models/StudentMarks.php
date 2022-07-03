<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentMarks extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'term_id',
        'maths',
        'science',
        'history',
        'total_marks'
    ];

    public function term(){
        return $this->hasOne(Term::class, 'id', 'term_id');
    }

    public function students(){
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }
}
