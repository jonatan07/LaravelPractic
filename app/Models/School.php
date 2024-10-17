<?php 


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function scopeLastName($query,$description)
    {
        if(!empty($description))
        {
            return $query->where('description', 'like', '%' . $description . '%');;
        }
    }

}

?>