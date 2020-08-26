<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GenralTraits;
use Illuminate\Http\Request;
use Auth;
class AuthAdminController extends Controller
{
    use GenralTraits;

    public function checklogin(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request -> only(['email','password']) ;

            $token =  Auth::guard('admin-api') -> attempt($credentials);

            if(!$token)
                return $this->returnError('E001','بيانات الدخول غير صحيحة');

            $admin = Auth::guard('admin-api') -> user();
            $admin -> api_token = $token;
            //return token
            return $this -> returnData('admin' , $admin);

        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }
}
