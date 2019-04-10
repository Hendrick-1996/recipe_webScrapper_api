<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Instruction extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'step' => $this->step,
          'image' => $this->image,
          'text' => $this->text,
        ];
    }
}
