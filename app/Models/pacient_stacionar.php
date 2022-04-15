<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pacient_stacionar extends Model
{
  use HasFactory;

  protected $fillable = [
    'pacients_id',
    'stacionar_id',
    'date_in',
    'date_ou',
    'diagnoz',
    'inhome',
  ];

  protected $casts = [
    'date_in' => 'date:d/m/Y',
    'date_ou' => 'date:d/m/Y',
];

  public function pacients(){
      return $this->belongsTo(pacients::class, 'pacients_id');
  }

  public function stacionar(){
      return $this->belongsTo(stacionar::class, 'stacionar_id');
  }
}
