<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetForUserResource extends JsonResource
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
            "audio"=>$this->audio,
            // "bolezns"=>GetForUserResourceBolezn::collection($this->bolezns),
            "gruppasvs"=>$this->gruppasvs,
            "recepient"=>$this->recepient,
            "recommend"=>$this->recommend,
            "skrinning"=>$this->skrinning,
            "stacionars"=>$this->stacionars,
            "vacine"=>GetForUserResourceVacine::collection($this->vacine),
            "vich"=>$this->vich,

        ];
    }
}
