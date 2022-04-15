<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\descr_vacines;

use App\Http\Requests\VacineReq;
use App\Models\vacines;

class VacinesConroller extends Controller
{
  public function VacinesPage(){
    $vacines = descr_vacines::paginate(20);
    return view('pages.vacines', ['vacines' => $vacines]);
  }

  public function AddVacine(VacineReq $req){
    descr_vacines::create([
      'pname' => $req['vacine'],
    ]);
    flash('Запись вакцины добавлена')->success();
    return redirect()->back();
  }

  public function UpdateVacine(VacineReq $req, $id){
    descr_vacines::find($id)->update([
      'pname'    => $req['vacine'],
    ]);
    flash('Запись вакцины обновлена')->success();
    return redirect()->back();
  }

  public function DeleteVacine($id){
    descr_vacines::find($id)->Delete();
    flash('Запись вакцины удалена')->success();
    return redirect()->back();
  }
}
