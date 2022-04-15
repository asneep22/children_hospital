<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roddom extends Model
{
    use HasFactory;

    protected $fillable = [
     'pname',
   ];

   public function pacients(){
     return $this->hasMany(pacients::class);
   }
}
