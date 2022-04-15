<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Models\pacients;

class pacientsFilter extends QueryFilter{

  public function search($search = ''){
    $search = preg_replace('/[^\S\r\n]+/', ' ', $search);
    $words = explode(" ", $search);

    foreach ($words as $word) {
      $this->builder
      ->where('pacients.id', 'LIKE', '%'.$word.'%')
      ->orwhere('pacients.lastname', 'LIKE', '%'.$word.'%')
      ->orwhere('pacients.pname', 'LIKE', '%'.$word.'%')
      ->orwhere('pacients.surname', 'LIKE', '%'.$word.'%')
      ->orwhere('pacients.birthday', 'LIKE', '%'.$word.'%')
      ->orwhere('uchastoks.pname', 'LIKE', '%'.$word.'%')
      ->orwhere('roddoms.pname', 'LIKE', '%'.$word.'%')
      ->orwhere('pacients.rost', 'LIKE', '%'.$word.'%')
      ->orwhere('pacients.ves', 'LIKE', '%'.$word.'%')
      ->orwhere('pacients.gestaci', 'LIKE', '%'.$word.'%');
    }
    return $this->builder;
  }

  public function sort_by_field_id($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('pacients.id', $value);
    });
  }

  public function sort_by_field_lastname($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('lastname', $value);
    });
  }

  public function sort_by_field_pname($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('pacients.pname', $value);
    });
  }

  public function sort_by_field_surname($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('pacients.surname', $value);
    });
  }

  public function sort_by_field_birthday($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('pacients.birthday', $value);
    });
  }

  public function sort_by_field_uchastok_name($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('uchastoks.pname', $value);
    });
  }

  public function sort_by_field_roddom_name($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('roddoms.pname', $value);
    });
  }

  public function sort_by_field_rost($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('pacients.rost', $value);
    });
  }

  public function sort_by_field_ves($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('pacients.ves', $value);
    });
  }

  public function sort_by_field_gestaci($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('pacients.gestaci', $value);
    });
  }

  public function sort_by_field_reccomend($value = null){
    return $this->builder->when($value, function($query) use($value) {
      $query->orderBy('pacients.reccomend', $value);
    });
  }
}
