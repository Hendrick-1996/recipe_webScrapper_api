<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;
use App\Http\Resources\Recipe as RecipeResource;
use App\Http\Resources\RecipeCollection;

class RecipeController extends Controller
{
    // suggest recipes based on provided ingredients
   public function recipe_search(Request $request)
   {
    
      $ingredients = explode(",",$request->ingredients);

      $recipes =  Recipe::whereHas('ingredients',function($query) use ($ingredients){
        foreach ($ingredients as $ingredient) {
          $query->where('name','LIKE',"%{$ingredient}%");
        }
      })->get();

      // dd($recipes);
      return RecipeResource::collection($recipes);

   }

}
