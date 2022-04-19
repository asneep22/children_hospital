<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\vacines;
use App\Models\descr_vacines;

class PacientVacineController extends Controller
{
    public function savevacine(Request $request)
    {
        descr_vacines::find($request->id)->update($request->all());
        return "success";
    }

    public function vacinedelete(Request $request)
    {
        $pac = vacines::where("descr_vacines_id", $request->id)->count();
        if ($pac) return "error";
        descr_vacines::find($request->id)->delete();
        return "success";
    }
    public function AddVacine(Request $req, $id)
    {
        vacines::where('pacients_id', $id)->delete();
        $pac_vacines = $req->input('states');

        foreach ($pac_vacines as $pac_vacine) {
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
