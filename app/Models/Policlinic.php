<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policlinic extends Model
{
    use HasFactory;
    protected $fillable = [
        'pname',
        'address',
        'zavedname',
      ];
}
