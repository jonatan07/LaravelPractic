<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = "Teachers";

    protected $fillable = [
        'name',
        'lastName',
    ];
    public static function scopeName($query,$name)
    {
        if(!empty($name))
        {
            return $query->where('name', 'like', '%' . $name . '%');;
        }
    }
    public function scopeLastName($query,$lastName)
    {
        if(!empty($lastName))
        {
            return $query->where('lastName', 'like', '%' . $lastName . '%');;
        }
    }

}


?>