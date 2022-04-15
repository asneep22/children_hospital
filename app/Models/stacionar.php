<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stacionar extends Model
{
    use HasFactory;

    protected $fillable = [
     'pname',
   ];

   public function stacionar(){
       return $this->belongsTo(pacient_stacionar::class);
   }
}
