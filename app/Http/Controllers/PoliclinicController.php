<?php

namespace App\Http\Controllers;

use App\Models\Policlinic;
use Illuminate\Http\Request;

class PoliclinicController extends Controller
{
    public function save(Request $request){
        Policlinic::first()->update($request->all());
    }
}
