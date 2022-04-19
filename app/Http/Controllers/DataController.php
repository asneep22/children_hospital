<?php

namespace App\Http\Controllers;

use App\Models\uchastok;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function uchastki()
    {
        $customers = uchastok::all();
 
    }
}
