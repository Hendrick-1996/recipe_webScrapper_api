<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;
use App\Http\Resources\Recipe as RecipeResource;
use App\Http\Resources\RecipeCollection;

class RecipeController extends Controller
{
    // suggest recipes based on provided ingredients
   public function recipe_search()
   {
      $recipes = Recipe::paginate(20);
      return RecipeResource::collection($recipes);

   }

}
