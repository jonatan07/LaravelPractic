<?php

namespace App\Http\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentValidator
{
    public static function Valid(Request $request)
    {
        $data =[
            'isValid' => false,
            'error' => ''
        ];
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email',
            'lastName' => 'required|min:4',
            'phone' => 'required|min:10|max:12',
        ]);

        if($validator->fails())
        {
            $data['error'] = $validator->errors();
        }
        else
        {
            $data['isValid'] = true;
        }
        return $data;
    }
}

?>