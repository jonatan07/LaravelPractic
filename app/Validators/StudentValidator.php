<?php

namespace App\Validators;

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
            'name' => 'required',
            'email' => 'required | email:unique',
            'lastName' => 'required',
            'phone' => 'required',
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