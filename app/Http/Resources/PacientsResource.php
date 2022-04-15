<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PacientsResource extends JsonResource
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
            'id' => $this->id,
            'lastname' => $this->lastname,
            'pname' => $this->pname,
            'surname' => $this->surname,
            'birthday' => date('d.m.Y', strtotime($this->birthday)),
            'uchastok_id' => $this->uchastok_id,
            'uchastok_name' => $this->uchastok_name,
            'rost' => $this->rost,
            'ves' => $this->ves,
            'pol' => $this->pol,
            'gestaci' => $this->gestaci,
            'roddom_id' => $this->roddom_id,
            'roddom_name' => $this->uchastok_name,
            'skrinning' => $this->skrinning,
            'audio' => $this->audio,
            'vich' => $this->vich,
            'gepatit' => $this->gepatit,
            'recepient' => $this->recepient,
            'gruppasvs' => $this->gruppasvs,
            'recommend' => $this->recommend,
        ];
    }
}
