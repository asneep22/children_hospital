<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RoddomRequest;
use App\Models\pacients;
use App\Models\roddom;

class RoddomController extends Controller
{
  public function RoddomsPage(){
    $roddoms = roddom::paginate(20);
    return view('pages.roddoms', ['roddoms' => $roddoms]);
  }

  public function AddRoddom(RoddomRequest $req){
    roddom::create([
      'pname' => $req['roddom'],
    ]);
    flash('Запись роддома добавлена')->success();
    return redirect()->back();
  }
  public function saveroddom(Request $request){
    roddom::find($request->id)->update($request->all());
    return "success";
  }
  public function roddomdelete(Request $request){
    $pac=pacients::where("roddom_id",$request->id)->count();
    if($pac) return "error";
    roddom::find($request->id)->delete();
    return "success";
  }

  public function UpdateRoddom(RoddomRequest $req, $id){
    roddom::find($id)->update([
      'pname' => $req['roddom'],
    ]);
    flash('Запись роддома обновлена')->success();
    return redirect()->back();
  }

  public function DeleteRoddom($id){
    roddom::find($id)->Delete();
    flash('Запись роддома удалена')->success();
    return redirect()->back();
  }
}
