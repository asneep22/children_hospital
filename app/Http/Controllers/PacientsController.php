<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\roddom;
use App\Models\uchastok;
use App\Http\Requests\PacientRequest;
use App\Models\pacients;
use App\Http\Resources\GetForUserResource;
use App\Models\bolezn;
use App\Models\descr_vacines;
use App\Models\pacient_bolezn;
use App\Models\pacient_stacionar;
use App\Models\Policlinic;
use App\Models\stacionar;
use App\Models\vacines;
use Illuminate\Support\Facades\Auth;

class PacientsController extends Controller
{
  public function full($id)
  {
    // return $id;
    $vacines = descr_vacines::all()->keyBy("id")->toArray();
    $stacionar = stacionar::all()->keyBy("id")->toArray();
    $bolezn = bolezn::all()->keyBy("id")->toArray();
    $pacient = pacients::with("vacine", "stacionars")->find($id);

    $pacient->birthday1 = date("Y-m-d", strtotime($pacient->birthday));
    $pacient->date_add1 = date("Y-m-d", strtotime($pacient->date_add));
    if ($pacient->vacine) {
      $ve = [];
      foreach (json_decode($pacient->vacine) as $pac) {
        $ve[] = $vacines[$pac->descr_vacines_id]["pname"];
      }
    }
    if ($pacient->stacionars) {
      $st = [];
      foreach (json_decode($pacient->stacionars) as $pac) {
        $b = pacient_bolezn::where("pacient_stacionar_id", $pac->id)->get();
        $allb = [];
        if ($b) {
          foreach ($b as $b) {
            $allb[] = $bolezn[$b->bolezn_id]["pname"];
          }
        }

        $st[] = [
          "pac_date_in" => $pac->date_in, "date_in1" => date("d.m.Y", strtotime($pac->date_in)), "pac_date_ou" => $pac->date_ou, "date_ou1" => date("d.m.Y", strtotime($pac->date_ou)),
          "pac_stacionar_id" => $stacionar[$pac->stacionar_id]["pname"], "vid" => $pac->vid == "inhome" ? "На дому" : ($pac->vid == "stacionar" ? "Стационар" : "Роддом"),
          "pac_diagnoz" => [$allb], "pac_recommends" => $pac->recommend
        ];
      }
    }
    $pacient->vac = $ve;
    $pacient->st = $st;
    return $pacient;
  }
  public function report_analiz($d1, $d2)
  {
    $policlinic = Policlinic::first();
    $wordTest = new \PhpOffice\PhpWord\PhpWord();
    $wordTest->setDefaultFontName('Times New Roman');
    $wordTest->setDefaultFontSize(12);
    $section = $wordTest->addSection();
    $d11 = date("d.m.Y", strtotime($d1));
    $d22 = date("d.m.Y", strtotime($d2));
    $res = pacients::whereBetween("birthday", [$d1, $d2])->count();
    $res1 = pacients::whereBetween("birthday", [$d1, $d2])->whereHas('stacionars', function ($query) use ($d1, $d2) {
      $query->whereBetween('date_in', [$d1, $d2]);
    })->count();
    $res2 = pacients::whereBetween("birthday", [$d1, $d2])->whereHas('stacionars', function ($query) use ($d1, $d2) {
      $query->where("vid", "stacionar")->whereBetween('date_in', [$d1, $d2]);
    })->count();
    //
    $res3 = pacients::with("stacionars")->get();
    // return $res3;
    $ds[0] = 0;
    $ds[1] = 0;
    $dl[0] = 0;
    $ds[2] = 0;
    $dl[1] = 0;
    $dl[2] = 0;
    foreach ($res3 as $res3) {


      // return $bd;
      // return $res3->stacionars;
      if (count($res3->stacionars) > 0) {
        $stac = json_decode($res3->stacionars);
        $s = $stac[0];
        $bd = $res3->birthday;
        if ($s->vid == "roddom") {

          $date1 = strtotime($bd);
          $date2 = strtotime($s->date_in);
          $diff = abs($date2 - $date1);
          $cd = floor($diff / 60 / 60 / 24);
          if ($cd < 11) $ds[0]++;
          if ($cd > 10 && $cd < 21) $ds[1]++;
          if ($cd > 20 && $cd < 31) $ds[2]++;
        }
        foreach ($stac as $st) {
          if ($st->vid != "roddom") {
            $date1 = strtotime($bd);
            $date2 = strtotime($st->date_in);
            $diff = abs($date2 - $date1);
            $cd = floor($diff / 60 / 60 / 24);
            if ($cd < 11) $dl[0]++;
            if ($cd > 10 && $cd < 21) $dl[1]++;
            if ($cd > 20 && $cd < 31) $dl[2]++;
          }
        }

        // foreach($res3->stacionars as $val){

        //   return $res3->stacionars;
        // }
      }
    }


    $section->addText("Анализ заболеваемости новорожденных {$policlinic->pname}, {$policlinic->address} в период {$d11} по {$d22}",  ['bold' => true], ['bold' => true, 'align' => 'center']);

    $section->addTextBreak(2);
    $table = $section->addTable();
    $table->addRow();
    $table->addCell()->addText("Всего родилось детей     ");
    $table->addCell()->addText(" " . $res . " ", ['bold' => true, 'underline' => 'single']);
    $table->addRow();
    $table->addCell()->addText("Из них заболело (абс. число - %) -");
    $table->addCell()->addText($res1 . " (" . (round(($res1 / $res * 100), 2)) . "%)", ['bold' => true, 'underline' => 'single']);
    $table->addRow();
    $table->addCell()->addText("Госпитализированы (абс. число - %) -");
    $table->addCell()->addText($res2 . " (" . (round(($res2 / $res * 100), 2)) . "%)", ['bold' => true, 'underline' => 'single']);
    $section->addTextBreak(1);
    $section->addText("Распределение заболевших новорожденных по возрасту",  ['bold' => true], ['bold' => true, 'align' => 'center']);
    $table = $section->addTable([
      'borderSize' => 1, 'borderColor' => '000000', 'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50
    ]);
    $table->addRow();
    $table->addCell()->addText("До 10 дней", ['bold' => true]);
    $table->addCell()->addText("10-20 дней", ['bold' => true]);
    $table->addCell()->addText("20-30 дней", ['bold' => true]);
    $table->addRow();
    $table->addCell()->addText($ds[0], ['bold' => true]);
    $table->addCell()->addText($ds[1], ['bold' => true]);
    $table->addCell()->addText($ds[2], ['bold' => true]);

    $section->addTextBreak(1);
    $section->addText("После выписки из родильного дома",  ['bold' => true], ['bold' => true, 'align' => 'center']);
    $table = $section->addTable([
      'borderSize' => 1, 'borderColor' => '000000', 'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50
    ]);
    $table->addRow();
    $table->addCell()->addText("До 10 дней", ['bold' => true]);
    $table->addCell()->addText("10-20 дней", ['bold' => true]);
    $table->addCell()->addText("20-30 дней", ['bold' => true]);
    $table->addRow();
    $table->addCell()->addText($dl[0], ['bold' => true]);
    $table->addCell()->addText($dl[1], ['bold' => true]);
    $table->addCell()->addText($dl[2], ['bold' => true]);
    $section->addTextBreak(2);
    $section->addText('Зав. детским поликлиническим отделением________________________'  . $policlinic->zavedname);

    $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');
    try {
      $objectWriter->save(storage_path('Анализ заболеваемости новорожденных ' . $d11 . ' - ' . $d22 . '.docx'));
    } catch (Exception $e) {
    }

    return response()->download(storage_path('Анализ заболеваемости новорожденных ' . $d11 . ' - ' . $d22 . '.docx'))->deleteFileAfterSend(true);
  }
  public function report_nedo($d1, $d2)
  {
    //считаем все болезни
    $policlinic = Policlinic::first();
    $res = pacients::with("bolezn")->whereBetween("date_add", [$d1, $d2])->get();
    $boleznd = bolezn::all()->keyBy("id")->toArray();
    $bolezn = [];
    foreach ($res as $res) {
      if (count($res->bolezn)) {
        foreach ($res->bolezn as $bol) {
          if (!array_key_exists($boleznd[$bol->bolezn_id]["pname"], $bolezn)) {
            $bolezn[$boleznd[$bol->bolezn_id]["pname"]] = 1;
          } else {
            $bolezn[$boleznd[$bol->bolezn_id]["pname"]]++;
          }
        }
      }
    }

    $nedo = pacients::with("bolezn")->whereBetween("date_add", [$d1, $d2])->where('gestaci', "<", 37)->get();
    $enmt = pacients::with("bolezn")->whereBetween("date_add", [$d1, $d2])->where('ves', "<=", 1000)->get();
    $onmt = pacients::with("bolezn")->whereBetween("date_add", [$d1, $d2])->whereBetween('ves', [1001, 1500])->get();
    $q = pacients::with("bolezn")->whereBetween("date_add", [$d1, $d2])->get()->keyBy("id");

    $qa = [];
    foreach ($q as $q) {
      foreach (json_decode($q["bolezn"]) as $val) {
        if ($boleznd[$val->bolezn_id]["q"]) $qa[$q->id] = $q;
      }
    }

    $wordTest = new \PhpOffice\PhpWord\PhpWord();
    $wordTest->setDefaultFontName('Times New Roman');
    $wordTest->setDefaultFontSize(12);
    $section = $wordTest->addSection();
    $d11 = date("d.m.Y", strtotime($d1));
    $d22 = date("d.m.Y", strtotime($d2));
    $section->addText("Отчет по перинатальной патологии {$policlinic->pname}, {$policlinic->address} в период {$d11} по {$d22}",  ['bold' => true], ['bold' => true, 'align' => 'center']);
    // Наименование нозологий	Кол-во
    $table = $section->addTable([
      'borderSize' => 1, 'borderColor' => '000000', 'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50
    ]);
    $table->addRow();
    $table->addCell()->addText("Наименование нозологий", ['bold' => true]);
    $table->addCell()->addText("Кол-во", ['bold' => true]);
    foreach ($bolezn as $n => $v) {
      $table->addRow();
      $table->addCell()->addText($n);
      $table->addCell()->addText($v);
    }


    // $myTextElement->setFontStyle($fontStyle);

    $section->addText("Ф.И.О. детей с врожденной патологией (класс Q)",  ['bold' => true], ['bold' => true, 'align' => 'center']);
    $table = $section->addTable([
      'borderSize' => 1, 'borderColor' => '000000', 'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50
    ]);
    $table->addRow();
    $table->addCell()->addText("№", ['bold' => true]);
    $table->addCell()->addText("ФИО", ['bold' => true]);
    $table->addCell()->addText("Дата рождения", ['bold' => true]);
    $table->addCell()->addText("Адрес", ['bold' => true]);
    $table->addCell()->addText("Вес", ['bold' => true]);
    $table->addCell()->addText("Срок гестации", ['bold' => true]);
    $table->addCell()->addText("Диагноз", ['bold' => true]);
    $is = 1;
    foreach ($qa as $n => $v) {
      $table->addRow();
      $table->addCell()->addText($is++);
      $table->addCell()->addText($v->lastname . " " . $v->pname . " " . $v->surname);
      $table->addCell()->addText(date("d.m.Y", strtotime($v->birthday)));
      $table->addCell()->addText($v->address);
      $table->addCell()->addText($v->ves);
      $ve = floatval($v->gestaci);
      $drob = fmod($ve, 1) > 0 ? " и " . (fmod($ve, 1) * 10) . "/7 нед" : "";
      $table->addCell()->addText(floor($ve) . " нед." . $drob);
      $vas = [];
      foreach (json_decode($v->bolezn) as $ve) {
        $vas[] = $boleznd[$ve->bolezn_id]["pname"];
      }
      $table->addCell()->addText(implode(", ", $vas));
    }

    $section->addText("");
    $section->addText("");
    $section->addText('Зав. детским поликлиническим отделением________________________'  . $policlinic->zavedname);
    $section->addPageBreak();
    $section->addText("НЕДОНОШЕННЫЕ:", ['bold' => true, 'underline' => 'single'], ['align' => 'center']);
    $table = $section->addTable([
      'borderSize' => 1, 'borderColor' => '000000', 'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50
    ]);
    $table->addRow();
    $table->addCell()->addText("№", ['bold' => true]);
    $table->addCell()->addText("ФИО", ['bold' => true]);
    $table->addCell()->addText("Дата рождения", ['bold' => true]);
    $table->addCell()->addText("Адрес", ['bold' => true]);
    $table->addCell()->addText("Вес", ['bold' => true]);
    $table->addCell()->addText("Срок гестации", ['bold' => true]);
    $table->addCell()->addText("Диагноз", ['bold' => true]);
    foreach ($nedo as $n => $v) {
      $table->addRow();
      $table->addCell()->addText($n + 1);
      $table->addCell()->addText($v->lastname . " " . $v->pname . " " . $v->surname);
      $table->addCell()->addText(date("d.m.Y", strtotime($v->birthday)));
      $table->addCell()->addText($v->address);
      $table->addCell()->addText($v->ves);
      $ve = floatval($v->gestaci);
      $drob = fmod($ve, 1) > 0 ? " и " . (fmod($ve, 1) * 10) . "/7 нед" : "";
      $table->addCell()->addText(floor($ve) . " нед." . $drob);
      $vas = [];
      foreach (json_decode($v->bolezn) as $ve) {
        $vas[] = $boleznd[$ve->bolezn_id]["pname"];
      }
      $table->addCell()->addText(implode(", ", $vas));
    }

    $section->addText("ЭНМТ – 1",  ['bold' => true], ['bold' => true, 'align' => 'center']);
    $table = $section->addTable([
      'borderSize' => 1, 'borderColor' => '000000', 'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50
    ]);
    $table->addRow();
    $table->addCell()->addText("№", ['bold' => true]);
    $table->addCell()->addText("ФИО", ['bold' => true]);
    $table->addCell()->addText("Дата рождения", ['bold' => true]);
    $table->addCell()->addText("Адрес", ['bold' => true]);
    $table->addCell()->addText("Вес", ['bold' => true]);
    $table->addCell()->addText("Срок гестации", ['bold' => true]);
    $table->addCell()->addText("Диагноз", ['bold' => true]);
    foreach ($enmt as $n => $v) {
      $table->addRow();
      $table->addCell()->addText($n + 1);
      $table->addCell()->addText($v->lastname . " " . $v->pname . " " . $v->surname);
      $table->addCell()->addText(date("d.m.Y", strtotime($v->birthday)));
      $table->addCell()->addText($v->address);
      $table->addCell()->addText($v->ves);
      $ve = floatval($v->gestaci);
      $drob = fmod($ve, 1) > 0 ? " и " . (fmod($ve, 1) * 10) . "/7 нед" : "";
      $table->addCell()->addText(floor($ve) . " нед." . $drob);
      $vas = [];
      foreach (json_decode($v->bolezn) as $ve) {
        $vas[] = $boleznd[$ve->bolezn_id]["pname"];
      }
      $table->addCell()->addText(implode(", ", $vas));
    }

    $section->addText("ОНМТ – 1",  ['bold' => true], ['bold' => true, 'align' => 'center']);
    $table = $section->addTable([
      'borderSize' => 1, 'borderColor' => '000000', 'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
      'width' => 100 * 50
    ]);
    $table->addRow();
    $table->addCell()->addText("№", ['bold' => true]);
    $table->addCell()->addText("ФИО", ['bold' => true]);
    $table->addCell()->addText("Дата рождения", ['bold' => true]);
    $table->addCell()->addText("Адрес", ['bold' => true]);
    $table->addCell()->addText("Вес", ['bold' => true]);
    $table->addCell()->addText("Срок гестации", ['bold' => true]);
    $table->addCell()->addText("Диагноз", ['bold' => true]);
    foreach ($onmt as $n => $v) {
      $table->addRow();
      $table->addCell()->addText($n + 1);
      $table->addCell()->addText($v->lastname . " " . $v->pname . " " . $v->surname);
      $table->addCell()->addText(date("d.m.Y", strtotime($v->birthday)));
      $table->addCell()->addText($v->address);
      $table->addCell()->addText($v->ves);
      $ve = floatval($v->gestaci);
      $drob = fmod($ve, 1) > 0 ? " и " . (fmod($ve, 1) * 10) . "/7 нед" : "";
      $table->addCell()->addText(floor($ve) . " нед." . $drob);
      $vas = [];
      foreach (json_decode($v->bolezn) as $ve) {
        $vas[] = $boleznd[$ve->bolezn_id]["pname"];
      }
      $table->addCell()->addText(implode(", ", $vas));
    }

    $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');
    try {
      $objectWriter->save(storage_path('Отчет по перинатальной патологии ' . $d11 . ' - ' . $d22 . '.docx'));
    } catch (Exception $e) {
    }

    return response()->download(storage_path('Отчет по перинатальной патологии ' . $d11 . ' - ' . $d22 . '.docx'))->deleteFileAfterSend(true);
  }

  public function sved($id)
  {
    // return pacients::with('stacionars','vacine')->find($id);
    $pacient = new GetForUserResource(pacients::with('stacionars', 'vacine')
      ->find($id));
    if ($pacient) {
      // return $pacient;
      return view('components.pacientone')->with('pacient', $pacient->resolve());
    }
  }
  public function PacientsPage(Request $request)
  {
    if (!Auth::check()) {
      return view('pages.autoriz');
    }


    $search = $request->search ?? '';

    $date_add = isset($request->date_add) ?  explode(' - ', $request->date_add) : '';
    $birthday = isset($request->birthday) ?  explode(' - ', $request->birthday) : '';
    $uchastok_id = $request->uchastok_id ?? '';
    $roddom_id = $request->roddom_id ?? '';
    $bolezn = $request->bolezn ?? '';
    $pol = $request->pol ?? "";
    $vich = $request->vich ?? "";
    $skrinning = $request->skrinning ?? "";
    $gepatit = $request->gepatit ?? "";
    $gruppasvs = $request->gruppasvs ?? "";
    $recepient = $request->recepient ?? "";
    $ves = $request->ves ?? "";
    $vacine = $request->vacine ?? "";
    $gestaci = $request->gestaci ?? "";

    $roddoms = roddom::all()->keyBy("id")->sortBy("pname");
    $uchastoks = uchastok::all()->keyBy("id")->sortBy("pname");
    $stacionars = stacionar::all()->keyBy("id")->sortBy("pname");
    // $bolezns = bolezn::get()->sortBy("pname");
    $bolezns = bolezn::all()->keyBy("id")->sortBy("pname");
    $vacines = descr_vacines::all()->keyBy("id")->sortBy("pname");
    $policlinic = Policlinic::first();
    $check = isset($request->sort_field) ?  explode('|', $request->sort_field) : ['id', 'asc'];
    $q=function ($query) use ($date_add, $gepatit, $ves, $vacine, $gruppasvs, $recepient, $gestaci, $birthday, $search, $uchastok_id, $vich, $roddom_id, $pol, $bolezn, $skrinning) {
      if ($search) {
        $query->where('lastname', 'LIKE', '%' . $search . '%');
        $query->orWhere('pname', 'LIKE', '%' . $search . '%');
        $query->orWhere('surname', 'LIKE', '%' . $search . '%');
        $query->orWhere('recommend', 'LIKE', '%' . $search . '%');
      }
      if ($date_add) {
        $query->whereBetween('date_add', [date('Y-m-d', strtotime($date_add[0])), date('Y-m-d', strtotime($date_add[1]))]);
      }
      if ($ves) {
        if ($ves == 1)
          $query->whereBetween('ves', [1501, 2500]);
        if ($ves == 2)
          $query->whereBetween('ves', [1001, 1499]);
        if ($ves == 3)
          $query->where('ves', '<', 1001);
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
      if ($skrinning) {
        $query->where('skrinning', $skrinning);
      }
      if ($pol) {
        $query->where('pol', $pol == 2 ? 0 : 1);
      }
      if ($vich) {
        $query->where('vich', $vich);
      }
      if ($vacine) {
        if ($vacine == 1)
          $query->where('gepatitb', 0)->where('bcjm', 0);
        if ($vacine == 2)
          $query->where('gepatitb', 1)->where('bcjm', 0);
        if ($vacine == 3)
          $query->where('gepatitb', 0)->where('bcjm', 1);
        if ($vacine == 4)
          $query->where('gepatitb', 1)->where('bcjm', 1);
      }
      if ($gestaci) {
        if ($gestaci == 1)
          $query->where('gestaci', ">=", 42);
        if ($gestaci == 2)
          $query->whereBetween('gestaci', [39, 41.6]);
        if ($gestaci == 3)
          $query->whereBetween('gestaci', [37, 38.6]);
        if ($gestaci == 4)
          $query->whereBetween('gestaci', [34, 36.6]);
        if ($gestaci == 5)
          $query->whereBetween('gestaci', [32, 33.6]);
        if ($gestaci == 6)
          $query->whereBetween('gestaci', [28, 31.6]);
        if ($gestaci == 7)
          $query->where('gestaci', "<", 28);
      }

      if ($gruppasvs) {
        $query->where('gruppasvs', $gruppasvs);
      }
      if ($recepient) {
        $query->where('recepient', $recepient);
      }
      if ($gepatit) {
        $query->where('gepatit', $vich);
      }
      if ($bolezn) {
        $query->whereHas('bolezns', function ($q) use ($bolezn) {
          return $q->where('bolezn_id', '=', $bolezn);
        });
      }
    };
    $statistic = pacients::with("bolezn")->where($q)->get();
    $ls=[];
    $uch=[];
    foreach($statistic as $st){
      foreach($st["bolezn"] as $bol){
        if(!isset($ls[$bolezns[$bol->bolezn_id]->pname]))$ls[$bolezns[$bol->bolezn_id]->pname]=0;
        $ls[$bolezns[$bol->bolezn_id]->pname]++;
      }
      // return $uchastoks;
      if(!isset($uch[$uchastoks[$st->uchastok_id]->pname]))$uch[$uchastoks[$st->uchastok_id]->pname]=0;
      $uch[$uchastoks[$st->uchastok_id]->pname]++;
      

    }

    $pacients1 = pacients::where($q)
      ->orderBy($check[0], $check[1])->paginate(25);

      // return $pacients1;
    return view('pages.pacients', ['pacients1' => $pacients1, "statistic"=>$ls, "uch"=>$uch, 'policlinic' => $policlinic, 'stacionars' => $stacionars, 'vacines' => $vacines, 'roddoms' => $roddoms, 'bolezns' => $bolezns, 'uchastoks' => $uchastoks, 'check' => $check]);
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
    if ($req->userid) {
      $pac = pacients::find($req->userid);
      $pac->update($req->all());
    } else {
      $pac = pacients::create($req->all());
    }

    pacient_stacionar::where('pacients_id', $pac->id)->delete();
    //  return $req->di;
    if ($req->di)
      foreach ($req->di as $di) {
        $diag = json_decode($di);
        $vid = $diag->vid == "Роддом" ? "roddom" : ($diag == "Стационар" ? "stacionar" : "inhome");
        $stacionar_id = stacionar::firstOrCreate([
          'pname' => $diag->pac_stacionar_id
        ]);
        $recommend = $diag->pac_recommends;
        $date_in = $diag->pac_date_in;
        $date_ou = $diag->pac_date_ou;
        $pc = pacient_stacionar::create([
          "vid" => $vid, "stacionar_id" => $stacionar_id->id,
          "pacients_id" => $pac->id,
          "recommend" => $recommend ?? "", "date_in" => $date_in, "date_ou" => $date_ou,
        ]);
        foreach ($diag->pac_diagnoz as $diagnoz) {
          foreach ($diagnoz as $diagnoz) {
            $bolezn = bolezn::firstOrCreate([
              'pname' => $diagnoz
            ]);
            pacient_bolezn::create(["pacient_stacionar_id" => $pc->id, "bolezn_id" => $bolezn->id]);
          }
        }
        // $pac_stacionar_id =  $req->pac_stacionar_id;

        //json_decode($di)->vid;
      }
    vacines::where('pacients_id', $pac->id)->delete();
    if ($req->vacine) {


      foreach ($req->vacine as $vacine) {
        $vac = descr_vacines::firstOrCreate([
          'pname' => $vacine
        ]);

        vacines::create([
          'pacients_id' => $pac->id,
          'descr_vacines_id' => $vac->id,
        ]);
      }
    }



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
