<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClassroom extends Model
{
    use HasFactory;
    protected $table = "StudentClassroom";

    protected $fillable = [
        'studentId',
        'classroomId',
    ];
    public static function scopeName($query,$studentId)
    {
        if(!empty($studentId))
        {
            return $query->where('studentId', 'like', '%' . $studentId . '%');;
        }
    }
    public function scopeLastName($query,$classroomId)
    {
        if(!empty($classroomId))
        {
            return $query->where('classroomId', 'like', '%' . $classroomId . '%');;
        }
    }

}



?>