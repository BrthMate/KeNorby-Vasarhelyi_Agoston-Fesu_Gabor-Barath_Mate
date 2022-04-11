<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function signIn(Request $request){
        $data = DB::table('authentication')
                ->where("UserName", $request->UserName)
                ->get();
        if(password_verify( $request->UserPass,$data[0]->UserPass)){
            $success["Id"] = $data[0]->Id;
            $success["UserName"] = $data[0]->UserName;
            $success["Sid"]=$request->Sid;
            
            DB::table('authentication')
              ->where('Id', $success["Id"])
              ->update(['Token' => $request->Sid]);

            return $this->sendResponse($success, "Sikeres bejelentkezés");
        }
        else{
            return $this->sendError("Unauthorized", ['error' => "Hibás adatok"] );
        }
    }
    
    public function logout( Request $request ) {
        DB::table('authentication')
              ->where('Token', $request->Sid)
              ->update(['Token' => ""]);

        return $this->sendResponse([], "Sikeres kijelentkezés");
    }
}
