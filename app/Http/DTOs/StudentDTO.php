<?php

namespace App\Http\DTOs;
use App\Models\Student;

class StudentDTO
{
    public readonly string $id;
    public readonly string $name;
    public readonly string $lastName;
    public readonly string $email;
    public readonly string $phone;
    public readonly string $address;

    public function __construct(Student $student)
    {
        $this->id = $student->id;
        $this->name = $student->name;
        $this->lastName = $student->lastName;
        $this->email = $student->email;
        $this->phone = $student->phone;
        $this->address = $student->address;
    
    }
    public static function fromModel(Student $student)
    {
        return new self($student);
    }

}

?>