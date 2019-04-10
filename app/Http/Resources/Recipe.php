<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Ingredient as IngredientResource;
use App\Http\Resources\IngredientCollection;

use App\Http\Resources\Instruction as InstructionResource;
use App\Http\Resources\InstructionCollection;

class Recipe extends JsonResource
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
          'id' => $this->id,
          'name' => $this->name,
          'image_link' => $this->image,
          'rating' => $this->rating,
          'serves' => $this->serves,
          'cook_time' => $this->cook_time,
          'ingredients' => IngredientResource::collection($this->ingredients),
          'instructions' => InstructionResource::collection($this->instructions)
        ];
    }
}
