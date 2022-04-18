<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;

class pacients extends Model
{
  use HasFactory;

  protected $fillable = [
    'lastname',
    'pname',
    'surname',
    'birthday',
    'address',
    'uchastok_id',
    'rost',
    'ves',
    'pol',
    'gestaci',
    'roddom_id',
    'skrinning',
    'audio',
    'vich',
    'gepatit',
    'recepient',
    'gruppasvs',
    'recommend',
    'date_add'
  ];

  protected $casts = [
    'birthday' => 'datetime:d/m/Y',
    'date_add'=> 'datetime:d/m/Y',
];

public function bolezn(){
  return $this->hasManyThrough(pacient_bolezn::class,pacient_stacionar::class);
} 

  public function uchastok(){
      return $this->belongsTo(uchastok::class);
  }

  public function roddom(){
      return $this->belongsTo(roddom::class);
  }

  public function stacionars(){
      return $this->hasMany(pacient_stacionar::class);
  }

  public function vacine(){
      return $this->hasMany(vacines::class);
  }
}
