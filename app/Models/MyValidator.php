<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class MyValidator extends Model
{
    use HasFactory;

    public $validated;

    public function validate($request, array $rules)
    {
        $validated = Validator::make($request, $rules);

        if ($validated->passes()){
            return true;
        }else{
            $errors = $validated->errors()->toArray();
            foreach ($errors as $error_key => $error_val) {
                $errors_arr[$error_key] = $error_val;
            }
            return $errors_arr;
        }
    }

}
