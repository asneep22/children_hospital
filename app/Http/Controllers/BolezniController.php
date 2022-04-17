<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BoleznReq;
use App\Models\bolezn;
use App\Models\pacient_bolezn;

class BolezniController extends Controller
{
  public function BolezniPage(){
    $bolezni = bolezn::paginate(20);
    return view('pages.bolezni', ['bolezni' => $bolezni]);
  }

  public function PacientAddBolezn(Request $req, $id){
    pacient_bolezn::where('stacionar_id', $id)->delete();
    $pac_bolezns = $req->input('bolezn');

    foreach($pac_bolezns as $pac_bolezn){
        $bolezn = bolezn::create([
            'pname' => $pac_bolezn,
        ]);

        pacient_bolezn::create([
            'stacionar_id' => $id,
            'bolezn_id' => $bolezn->id,
        ]);
    }
}

  public function AddBolezn(BoleznReq $req){
    bolezn::create([
      'pname' => $req['bolezn'],
    ]);
    flash('Запись болезни добавлена')->success();
    return redirect()->back();
  }

  public function UpdateBolezn(BoleznReq $req, $id){
    bolezn::find($id)->update([
      'pname' => $req['bolezn'],
    ]);
    flash('Запись болезни обновлена')->success();
    return redirect()->back();
  }

  public function DeleteBolezn($id){
    bolezn::find($id)->Delete();
    flash('Запись болезни удалена')->success();
    return redirect()->back();
  }
}
