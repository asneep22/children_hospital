<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bolezn extends Model
{
    use HasFactory;

    protected $fillable = [
      'pname', 'q'
    ];

    public function bolezn(){
      return $this->hasMany(pacient_bolezn::class);
    }
}
