<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pacient_bolezn extends Model
{
    use HasFactory;

    protected $fillable = [
      'pacients_id',
      'bolezn_id',
      'date_in',
      'date_ou',
    ];

    protected $casts = [
      'date_in' => 'date:d/m/Y',
      'date_ou' => 'date:d/m/Y',
  ];

    public function bolezns(){
      return $this->belongsTo(pacients::class);
    }

    public function descr(){
      return $this->belongsTo(bolezn::class, 'bolezn_id');
    }
    public function descr1(){
      return $this->belongsTo(bolezn::class,"bolezn_id","id");
    }
}
