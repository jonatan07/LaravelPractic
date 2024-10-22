<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Classroom extends Model
{
    use HasFactory;
    protected $table = "Classrooms";

    protected $fillable = [
        'name',
        'chairsAvailable',
        'school_id',
        'teacher_id',
    ];
    public static function scopeName($query,$name)
    {
        if(!empty($name))
        {
            return $query->where('name', 'like', '%' . $name . '%');;
        }
    }
    public static function scopeBySchool($query,$idSchool)
    {
        if(!empty($idSchool))
        {
            return $query->where('school_id', '=',  $idSchool );
        }
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }
    public function school(): HasOne
    {
        return $this->hasOne(School::class);
    }

}
?>