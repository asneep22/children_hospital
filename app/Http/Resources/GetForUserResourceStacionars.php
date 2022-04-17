<?php

namespace App\Http\Resources;

use App\Models\pacient_bolezn;
use Illuminate\Http\Resources\Json\JsonResource;

class GetForUserResourceStacionars extends JsonResource
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
            "bolezns"=>GetForUserResourceBolezn::collection(pacient_bolezn::where("pacient_stacionar_id",$this->id)->get()),
            "vid"=>$this->vid=="inhome"?"На дому":($this->vid=="roddom"?"Родильный дом":"Стационар"),
            "date_in"=>date("d.m.Y", strtotime($this->date_in)),
            "date_ou"=>date("d.m.Y", strtotime($this->date_ou)),
            "recommend"=>$this->recommend,
        ];
    }
}
