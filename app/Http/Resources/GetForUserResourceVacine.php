<?php

namespace App\Http\Resources;

use App\Models\vacines;
use Illuminate\Http\Resources\Json\JsonResource;

class GetForUserResourceVacine extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "vacine"=>$this->descr_vacines->pname
        ];
    }
}
