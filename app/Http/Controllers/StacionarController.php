<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StacionarReq;
use App\Models\pacient_stacionar;
use App\Models\stacionar;

class StacionarController extends Controller
{
  public function StacionarsPage(){
    $stacionars = stacionar::paginate(20);
    return view('pages.stacionars', ['stacionars' => $stacionars]);
  }
  public function savestacionar(Request $request){
    stacionar::find($request->id)->update($request->all());
    return "success";
  }

  public function stacionardelete(Request $request){
    $pac=pacient_stacionar::where("stacionar_id",$request->id)->count();
    if($pac) return "error";
    stacionar::find($request->id)->delete();
    return "success";
  }

  public function AddStacionar(StacionarReq $req){
    stacionar::create([
      'pname' => $req['stacionar'],
    ]);
    flash('Запись стационара добавлена')->success();
    return redirect()->back();
  }

  public function UpdateStacionar(StacionarReq $req, $id){
    stacionar::find($id)->update([
      'pname' => $req['stacionar'],
    ]);
    flash('Запись стационара обновлена')->success();
    return redirect()->back();
  }

  public function DeleteStacionar($id){
    stacionar::find($id)->Delete();
    flash('Запись стационара удалена')->success();
    return redirect()->back();
  }
}
