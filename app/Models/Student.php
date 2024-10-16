<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Student extends Model
{
    use HasFactory;
    protected $table = "Students";

    protected $fillable = [
        'name',
        'lastName',
        'email',
        'phone',
        'address'
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
    public function scopeEmail($query,$email)
    {
        if(!empty($email))
        {
            return $query->where('email', 'like', '%' . $email . '%');;
        }
    }
    public function scopePhone($query,$phone)
    {
        if(!empty($phone))
        {
            return $query->where('name', 'like', '%' . $phone . '%');
        }
    }
}

?>