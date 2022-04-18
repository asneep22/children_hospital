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
use App\Models\bolezn;
use App\Models\Policlinic;

class PacientsController extends Controller
{
  public function report_nedo($d1,$d2){
    //считаем все болезни
    $policlinic=Policlinic::first();
      $res=pacients::with("bolezn")->whereBetween("date_add",[$d1,$d2])->get();
      $boleznd=bolezn::all()->keyBy("id")->toArray();
      $bolezn=[];
      foreach($res as $res){
        if(count($res->bolezn)){
          foreach($res->bolezn as $bol){
           if(!array_key_exists($boleznd[$bol->bolezn_id]["pname"],$bolezn)){$bolezn[$boleznd[$bol->bolezn_id]["pname"]]=1;} else{
           $bolezn[$boleznd[$bol->bolezn_id]["pname"]]++;}
          }
        }
      }

      $nedo=pacients::with("bolezn")->whereBetween("date_add",[$d1,$d2])->where('gestaci',"<",37)->get();
      $enmt=pacients::with("bolezn")->whereBetween("date_add",[$d1,$d2])->where('ves',"<",1000)->get();
      $onmt=pacients::with("bolezn")->whereBetween("date_add",[$d1,$d2])->whereBetween('ves',[1000,1500])->get();
     
     
      $q=pacients::with("bolezn")->whereBetween("date_add",[$d1,$d2])->get()->keyBy("id");
      // return $q;
      $qa=[];
      foreach($q as $q){
        foreach(json_decode($q["bolezn"]) as $val){
          if($boleznd[$val->bolezn_id]["q"])$qa[$q->id]=$q;
            // return $val;
        }
      }
      

   
      // return $bolezn;
      $wordTest = new \PhpOffice\PhpWord\PhpWord();
      $wordTest->setDefaultFontName('Times New Roman');
      $wordTest->setDefaultFontSize(12);
      $section = $wordTest->addSection();
      // $fontStyle = new \PhpOffice\PhpWord\Style\Font();
      // $fontStyle->setBold(true);
      $d11=date("d.m.Y",strtotime($d1));
      $d22=date("d.m.Y",strtotime($d2));
      $section->addText("Отчет по перинатальной патологии {$policlinic->pname}, {$policlinic->address} в период {$d11} по {$d22}",  ['bold' => true], ['bold' => true,'align' => 'center']);
      

  


// Наименование нозологий	Кол-во
$table = $section->addTable(['borderSize' => 1, 'borderColor' => '000000','unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
'width' => 100 * 50]);
$table->addRow();
$table->addCell()->addText("Наименование нозологий",['bold' => true]);
$table->addCell()->addText("Кол-во",['bold' => true]);
foreach($bolezn as $n=>$v){
  $table->addRow();
  $table->addCell()->addText($n);
  $table->addCell()->addText($v);
}


      // $myTextElement->setFontStyle($fontStyle);

      $section->addText("Ф.И.О. детей с врожденной патологией (класс Q)",  ['bold' => true], ['bold' => true,'align' => 'center']);
      $table = $section->addTable(['borderSize' => 1, 'borderColor' => '000000','unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50]);
      $table->addRow();
      $table->addCell()->addText("№",['bold' => true]);
      $table->addCell()->addText("ФИО",['bold' => true]);
      $table->addCell()->addText("Дата рождения",['bold' => true]);
      $table->addCell()->addText("Адрес",['bold' => true]);
      $table->addCell()->addText("Вес",['bold' => true]);
      $table->addCell()->addText("Срок гестации",['bold' => true]);
      $table->addCell()->addText("Диагноз",['bold' => true]);
      foreach($qa as $n=>$v){
        $table->addRow();
        $table->addCell()->addText($n+1);
        $table->addCell()->addText($v->lastname." ".$v->pname." ".$v->surname);
        $table->addCell()->addText(date("d.m.Y",strtotime($v->birthday)));
        $table->addCell()->addText($v->address);
        $table->addCell()->addText($v->ves);
        
        $table->addCell()->addText($v->gestaci);
        $vas=[];
        foreach(json_decode($v->bolezn) as $ve)
        {
          $vas[] = $boleznd[$ve->bolezn_id]["pname"];
        }
        $table->addCell()->addText(implode(", ",$vas));
      }

      $section->addText("");
      $section->addText("");
      $section->addText('Зав. детским поликлиническим отделением________________________'  . $policlinic->zavedname);
      $section->addPageBreak();
      $section->addText("НЕДОНОШЕННЫЕ:",['bold' => true,'underline' => 'single'],['align' => 'center']);
      $table = $section->addTable(['borderSize' => 1, 'borderColor' => '000000','unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50]);
      $table->addRow();
      $table->addCell()->addText("№",['bold' => true]);
      $table->addCell()->addText("ФИО",['bold' => true]);
      $table->addCell()->addText("Дата рождения",['bold' => true]);
      $table->addCell()->addText("Адрес",['bold' => true]);
      $table->addCell()->addText("Вес",['bold' => true]);
      $table->addCell()->addText("Срок гестации",['bold' => true]);
      $table->addCell()->addText("Диагноз",['bold' => true]);
      foreach($nedo as $n=>$v){
        $table->addRow();
        $table->addCell()->addText($n+1);
        $table->addCell()->addText($v->lastname." ".$v->pname." ".$v->surname);
        $table->addCell()->addText(date("d.m.Y",strtotime($v->birthday)));
        $table->addCell()->addText($v->address);
        $table->addCell()->addText($v->ves);
        
        $table->addCell()->addText($v->gestaci);
        $vas=[];
        foreach(json_decode($v->bolezn) as $ve)
        {
          $vas[] = $boleznd[$ve->bolezn_id]["pname"];
        }
        $table->addCell()->addText(implode(", ",$vas));
      }

      $section->addText("ЭНМТ – 1",  ['bold' => true], ['bold' => true,'align' => 'center']);
      $table = $section->addTable(['borderSize' => 1, 'borderColor' => '000000','unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50]);
      $table->addRow();
      $table->addCell()->addText("№",['bold' => true]);
      $table->addCell()->addText("ФИО",['bold' => true]);
      $table->addCell()->addText("Дата рождения",['bold' => true]);
      $table->addCell()->addText("Адрес",['bold' => true]);
      $table->addCell()->addText("Вес",['bold' => true]);
      $table->addCell()->addText("Срок гестации",['bold' => true]);
      $table->addCell()->addText("Диагноз",['bold' => true]);
      foreach($enmt as $n=>$v){
        $table->addRow();
        $table->addCell()->addText($n+1);
        $table->addCell()->addText($v->lastname." ".$v->pname." ".$v->surname);
        $table->addCell()->addText(date("d.m.Y",strtotime($v->birthday)));
        $table->addCell()->addText($v->address);
        $table->addCell()->addText($v->ves);
        
        $table->addCell()->addText($v->gestaci);
        $vas=[];
        foreach(json_decode($v->bolezn) as $ve)
        {
          $vas[] = $boleznd[$ve->bolezn_id]["pname"];
        }
        $table->addCell()->addText(implode(", ",$vas));
      }

      $section->addText("ОНМТ – 1",  ['bold' => true], ['bold' => true,'align' => 'center']);
      $table = $section->addTable(['borderSize' => 1, 'borderColor' => '000000','unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50]);
      $table->addRow();
      $table->addCell()->addText("№",['bold' => true]);
      $table->addCell()->addText("ФИО",['bold' => true]);
      $table->addCell()->addText("Дата рождения",['bold' => true]);
      $table->addCell()->addText("Адрес",['bold' => true]);
      $table->addCell()->addText("Вес",['bold' => true]);
      $table->addCell()->addText("Срок гестации",['bold' => true]);
      $table->addCell()->addText("Диагноз",['bold' => true]);
      foreach($onmt as $n=>$v){
        $table->addRow();
        $table->addCell()->addText($n+1);
        $table->addCell()->addText($v->lastname." ".$v->pname." ".$v->surname);
        $table->addCell()->addText(date("d.m.Y",strtotime($v->birthday)));
        $table->addCell()->addText($v->address);
        $table->addCell()->addText($v->ves);
        
        $table->addCell()->addText($v->gestaci);
        $vas=[];
        foreach(json_decode($v->bolezn) as $ve)
        {
          $vas[] = $boleznd[$ve->bolezn_id]["pname"];
        }
        $table->addCell()->addText(implode(", ",$vas));
      }


                         
      


      $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');
      try 
      {
          $objectWriter->save(storage_path('TestWordFile.docx'));
      } 
      catch (Exception $e) 
      {
      }
  
      return response()->download(storage_path('TestWordFile.docx'));
  }
  public function sved($id){
    // return pacients::with('stacionars','vacine')->find($id);
    $pacient = new GetForUserResource(pacients::with('stacionars','vacine')
    ->find($id));
    if($pacient){
      // return $pacient;
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
