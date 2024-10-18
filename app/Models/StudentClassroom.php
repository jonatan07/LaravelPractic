<?php

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentClassroom extends Model
{
    use HasFactory;
    protected $table = "StudentClassroom";

    protected $fillable = [
        'studentId',
        'classroomId',
    ];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }
    public function classroom(): HasOne
    {
        return $this->hasOne(Classroom::class);
    }
}


?>