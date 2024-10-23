<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;
    protected $table = "Schools";

    protected $fillable = [
        'name',
        'description',
    ];
    public static function scopeName($query,$name)
    {
        if(!empty($name))
        {
            return $query->where('name', 'like', '%' . $name . '%');;
        }
    }
    public function scopeDescription($query,$description)
    {
        if(!empty($description))
        {
            return $query->where('description', 'like', '%' . $description . '%');;
        }
    }
    public function classroom():HasMany
    {
        return $this->hasMany(Classroom::class);
    }

}

?>