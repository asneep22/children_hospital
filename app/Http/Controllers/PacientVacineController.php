<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\vacines;
use App\Models\descr_vacines;

class PacientVacineController extends Controller
{
    public function AddVacine(Request $req, $id){
        vacines::where('pacients_id', $id)->delete();
        $pac_vacines = $req->input('states');

        foreach($pac_vacines as $pac_vacine){
            $vacine = descr_vacines::create([
                'pname' => $pac_vacine,
            ]);

            vacines::create([
                'pacients_id' => $id,
                'descr_vacines_id' => $vacine->id,
            ]);
        }
    }
}
