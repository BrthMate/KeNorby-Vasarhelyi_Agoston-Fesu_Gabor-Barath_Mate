<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KenorbyController extends BaseController
{
    public function update( Request $request ) {

        if(DB::table('mobil')
                ->where("UserId",$request->UserId)
                ->update(["Counter" => $request->Counter])){
                        return $this->sendResponse([], "Sikeres frissítés");
                    }
                    else{
                        return $this->sendError("Error", ['error' => "Hiba történt a folyamat során"] );
                    }
    }
    public function selectMyCounter(Request $request){
        $data = DB::table('mobil')
                ->where("UserId",$request->UserId)
                ->get();
        if($data){
            $success["Counter"] = $data[0]->Counter;
            return $this->sendResponse($success, "Sikeres lekérdezés");
        }
        else{
            return $this->sendError("Error", ['error' => "Hiba történt a folyamat során"] );
        }
    }
    public function sum(){
        $data = DB::table('mobil')
                ->sum("Counter");
        if($data){
            $success["Counter"] = $data;
            return $this->sendResponse($success, "Sikeres adat lekérés");
        }
        else{
            return $this->sendError("Error", ['error' => "Hiba történt a folyamat során"] );
        }
    }

    public function login(Request $request){
        $data = DB::table('kenorby')
                ->where("userName", $request->UserName)
                ->get();
        if(password_verify( $request->Password,$data[0]->Password)){
            $success["Id"] = $data[0]->Id;
            $success["UserName"] = $data[0]->userName;

            DB::table('kenorby')
            ->where('Id', $success["Id"])
            ->update(['Token' => $request->Sid]);

            return $this->sendResponse( $success, "Sikeres bejelentkezés");
        }
        else{
            return $this->sendError("Unauthorized", ['error' => "Hibás adatok"] );
        }
    }
    public function all_user(){
        $data = DB::table('authentication')
                ->join('allow', 'authentication.Allow', '=', 'allow.Allow')
                ->select('Email', 'UserName', 'Date','Text')
                ->get();
        if(isset($data)){
            $success["data"] = $data;
            return $this->sendResponse( $success, "Sikeres adat lekérés");
        }
        else{
            return $this->sendError("Error", ['error' => "Hibatörtént"] );
        }
    }
    public function create_admin(Request $request){
        $hashed_pass = password_hash($request->Password, PASSWORD_DEFAULT);
        if(DB::table('kenorby')->insert([
            ['UserName' => $request->UserName, 'Password' => $hashed_pass,"Token" => ""],
            ])){
            return $this->sendResponse( [], "Sikeres adat módosítás");
        }
        else{
            return $this->sendError("Error", ['error' => "Hibatörtént"] );
        }
    }
    public function active(Request $request){
        DB::table('authentication')
              ->where('UserName', $request->UserName)
              ->update(['Allow' => 0]);
        return $this->sendResponse( [], "Sikeres adat frissítés");
    }
    public function blocked(Request $request){
        DB::table('authentication')
              ->where('UserName', $request->UserName)
              ->update(['Allow' => 1]);
        return $this->sendResponse( [], "Sikeres adat frissítés");
    }
    public function update_user(Request $request){
        DB::table('authentication')
              ->where('Id', $request->Id)
              ->update(['Email' =>  $request->Email, 'UserName' =>  $request->UserName]);
        return $this->sendResponse( [], "Sikeres adat frissítés");
    }
    public function search_id(Request $request){
        $data = DB::table('authentication')
                ->select('Id')
                ->where('UserName', $request->UserName)
                ->get();
        if(isset($data)){
            $success["data"] = $data;
            return $this->sendResponse( $success, "Sikeres adat lekérés");
        }
        else{
            return $this->sendError("Error", ['error' => "Hibatörtént"] );
        }
    }
    public function search(Request $request){
        $data = DB::table('authentication')
                ->join('allow', 'authentication.Allow', '=', 'allow.Allow')
                ->select('Email', 'UserName', 'Date','Text')
                ->where('UserName', $request->UserName)
                ->get();
        if(isset($data)){
            $success["data"] = $data;
            return $this->sendResponse( $success, "Sikeres adat lekérés");
        }
        else{
            return $this->sendError("Error", ['error' => "Hibatörtént"] );
        }
    }         
}

