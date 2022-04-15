<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UchastokReq;
use App\Models\uchastok;

class UchastokController extends Controller
{
  public function UchastkiPage(){
    $uchastki = uchastok::paginate(20);
  //  return datatables()->of(uchastok::all())->toJson();
  
    return view('pages.uchastki', ['uchastki' => $uchastki]);
  }

  public function AddUchastok(UchastokReq $req){
    uchastok::create([
      'pname' => $req['uchastok'],
    ]);
    flash('Запись участка добавлена')->success();
    return redirect()->back();
  }

  public function UpdateUchastok(UchastokReq $req, $id){
    uchastok::find($id)->update([
      'pname' => $req['uchastok'],
    ]);
    flash('Запись участка обновлена')->success();
    return redirect()->back();
  }

  public function DeleteUchastok($id){
    uchastok::find($id)->Delete();
    flash('Запись участка удалена')->success();
    return redirect()->back();
  }
}
