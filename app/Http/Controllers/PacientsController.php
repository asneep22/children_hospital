<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Seblhaire\DateRangePickerHelper\DateRangePickerHelper;

use Illuminate\Http\Request;

use App\Models\roddom;
use App\Models\uchastok;
use App\Http\Requests\PacientRequest;
use App\Models\pacients;
use App\Http\Resources\GetForUserResource;

class PacientsController extends Controller
{
  public function sved($id){
    return pacients::with('stacionars','vacine')->find($id);
    $pacient = new GetForUserResource(pacients::with('stacionars','vacine')
    ->find($id));
    if($pacient){
      return $pacient;
      return view('components.pacientone')->with('pacient',$pacient->resolve());
      
    }
  }
  public function PacientsPage(Request $request)
  {

    $search = $request->search ?? '';

    $date_add = isset($request->date_add) ?  explode(' - ', $request->date_add) : '';
    $birthday = isset($request->birthday) ?  explode(' - ', $request->birthday) : '';
    $uchastok_id = $request->uchastok_id??'';
    $roddom_id = $request->roddom_id??'';
    $pol = $request->pol??"";
    
    $roddoms = roddom::all();
    $uchastoks = uchastok::all();
    $check = isset($request->sort_field) ?  explode('|', $request->sort_field) : ['id', 'asc'];
    $pacients1 = pacients::with(['roddom', 'uchastok'])
    ->where(function ($query) use ($date_add,$birthday,$search,$uchastok_id,$roddom_id,$pol) {
      if ($search){
        $query->where('lastname', 'LIKE', '%' . $search . '%');
        $query->orWhere('pname', 'LIKE', '%' . $search . '%');
        $query->orWhere('surname', 'LIKE', '%' . $search . '%');
        }
      if ($date_add) {
        $query->whereBetween('date_add', [date('Y-m-d', strtotime($date_add[0])), date('Y-m-d', strtotime($date_add[1]))]);
      }
      if ($birthday) {
        $query->whereBetween('birthday', [date('Y-m-d', strtotime($birthday[0])), date('Y-m-d', strtotime($birthday[1]))]);
      }
      if ($uchastok_id) {
        $query->where('uchastok_id', $uchastok_id);
      }
      if ($roddom_id) {
        $query->where('roddom_id', $roddom_id);
      }
      if ($pol) {
        $query->where('pol', $pol==2?0:1);
      }
    })
      ->orderBy($check[0], $check[1])
      ->paginate(25);
    //   $posts = Post::whereHas('comments', function (Builder $query) {
    //     $query->where('content', 'like', 'code%');
    // }, '>=', 10)->get();




    // $pacients1 = pacients::with(['roddom', 'uchastok'])
    //   ->where('lastname', 'LIKE', '%' . $search . '%')
    //   ->orWhere('pname', 'LIKE', '%' . $search . '%')
    //   ->orWhere('surname', 'LIKE', '%' . $search . '%')
    //   ->orderBy($check[0], $check[1])
    //   ->paginate(25);

    return view('pages.pacients', ['pacients1' => $pacients1, 'roddoms' => $roddoms, 'uchastoks' => $uchastoks, 'check' => $check]);
  }

  public function AddPacient(PacientRequest $req)
  {

    if ($ucahstok = uchastok::firstOrCreate(
      ['id' => $req['uchastok_id']],
      ['pname' => $req['uchastok_id']]
    )) {
      $req['uchastok_id'] = $ucahstok->id;
    }

    if ($roddom = roddom::firstOrCreate(
      ['id' => $req['roddom_id']],
      ['pname' => $req['roddom_id']]
    )) {
      $req['roddom_id'] = $roddom->id;
    }

    pacients::create($req->all());

    flash('Запись пациента добавлена')->success();
    return redirect()->back();
  }

  public function UpdatePacient(PacientRequest $req, $id)
  {
    pacients::find($id)->update($req->all());
    flash('Запись пациента обновлена')->success();
    return redirect()->back();
  }

  public function DeletePacient($id)
  {
    pacients::find($id)->Delete();
    flash('Запись пациента удалена')->success();
    return redirect()->route('PacientsPage');
  }

  public function PacientsSortByLastnamme($value = null)
  {
    return $this->builder->when($value, function ($query) use ($value) {
      $query->orderBy('lastname', $value);
    });
  }

  public function sort_by_field_pname($value = null)
  {
    return $this->builder->when($value, function ($query) use ($value) {
      $query->orderBy('pacients.pname', $value);
    });
  }

  public function sort_by_field_surname($value = null)
  {
    return $this->builder->when($value, function ($query) use ($value) {
      $query->orderBy('pacients.surname', $value);
    });
  }
}
