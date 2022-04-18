<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthReq;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function TryAuth(AuthReq $req){
      if(Auth::attempt($req->only(['login', 'password']))){
        return redirect()->route('PacientsPage');
      }

      return redirect()->route('AuthPage')->withErrors(['msg' => 'Введены неверные данные']);

    }

    public function Logout(){
      Auth::logout();
      return redirect()->route('PacientsPage');
    }
}
