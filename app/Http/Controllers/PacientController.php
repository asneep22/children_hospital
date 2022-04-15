<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use PDO;

use App\Models\vacines;
use App\Models\descr_vacines;
use App\Models\bolezn;
use App\Models\pacient_bolezn;
use App\Models\pacients;
use App\Models\uchastok;
use App\Models\roddom;
use App\Models\stacionar;
use App\Models\pacient_stacionar;

use App\Http\Requests\PacientStacionarRequest;

class PacientController extends Controller
{
  public function PacientPage($id)
  {
    session()->put('pacient_id', $id);

    $pacient = pacients::find($id);

    $all_vacines = descr_vacines::all();
    $pac_vacines = vacines::where('pacients_id', $id)->with('descr_vacines')->get();

    $all_bolezn = bolezn::all();
    $pac_bolezns = pacient_bolezn::where('pacients_id', $id)->with('bolezns')->get();

    $uchastoks = uchastok::all();
    $roddoms = roddom::all();
    $stacionars = stacionar::all();

    foreach ($pac_vacines as $vacine) {
      $all_vacines->find($vacine->descr_vacines_id)['selected'] = 1;
    }

    foreach ($pac_bolezns as $bolezn) {
      $all_bolezn->find($bolezn->bolezn_id)['selected'] = 1;
    }
    return view('pages.pac', ['vacines' => $all_vacines, 'bolezni' => $all_bolezn], compact('pacient', 'uchastoks', 'roddoms', 'stacionars'));
  }

  public function saveAll(Request $req, $id)
  {

    vacines::where('pacients_id', $id)->delete();

    if ($req->vacine) {
      foreach ($req->vacine as $elem) {
        if ($elem) {
          $elem = ucfirst(mb_strtolower(trim($elem)));
          $find_vacine = descr_vacines::where('pname', $elem)->first();
          if (!$find_vacine) {
            $find_vacine = descr_vacines::create(['pname' => $elem]);
          }
          vacines::create([
            'pacients_id' => $id,
            'descr_vacines_id' => $find_vacine->id,
          ]);
        }
      }
    }

      pacient_bolezn::where('pacients_id', $id)->delete();

      if ($req->bolezn){
        foreach ($req->bolezn as $elem) {
          if ($elem) {
            $elem = ucfirst(mb_strtolower(trim($elem)));
            $find_bolezn = bolezn::where('pname', $elem)->first();
            if (!$find_bolezn) {
              $find_bolezn = bolezn::create(['pname' => $elem]);
            }
            pacient_bolezn::create([
              'pacients_id' => $id,
              'bolezn_id' => $find_bolezn->id,
            ]);
          }
        }
      }

      pacients::find($id)->update($req->all());

    flash('Данные о пациенте сохранены')->success();
    return redirect()->back();
  }

  public function addPacientToStacionar(PacientStacionarRequest $req, $id){

    if($stacionar = stacionar::firstOrCreate(
      ['id' => $req['stacionar_id']],
      ['pname' => $req['stacionar_id']]
    )){
      $req['stacionar_id'] = $stacionar->id;
    }
    $req['pacients_id'] = $id;
    if (!$req['date_ou']){
    $req['date_ou'] = Carbon::create(2011,0,0);
  }

    pacient_stacionar::create($req->all());
    flash('Пациент добавлен в стационар')->success();
    return redirect()->back();
  }

  public function updatePacientStacionar(PacientStacionarRequest $req, $id){
    $req['pacient_id'] = session()->get('pacient_id');
    pacient_stacionar::find($id)->update($req->except('pacients_id'));
    flash('Запись стационара пациента обновлена')->success();
    return redirect()->back();
  }

  public function deletePacientStacionar($id){
      pacient_stacionar::find($id)->delete();
      flash('Запись стационара пациента удалена')->success();
      return redirect()->back();
  }
}
