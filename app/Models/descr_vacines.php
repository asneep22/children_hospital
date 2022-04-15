<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class descr_vacines extends Model
{
    use HasFactory;

    protected $fillable = [
      'pname',
    ];

    public function vacine(){
        return $this->hasMany(vacines::class);
    }
}
