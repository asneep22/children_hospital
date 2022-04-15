<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class vacines extends Model
{
  use HasFactory;

  protected $fillable = [
    'pacients_id',
    'descr_vacines_id',
  ];

  public function pacients(){
    return $this->belongsTo(pacients::class);
  }

  public function descr_vacines(){
      return $this->belongsTo(descr_vacines::class);
  }
}
