<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;
use App\Ingredient;
use App\Http\Resources\Recipe as RecipeResource;
use App\Http\Resources\RecipeCollection;

class RecipeController extends Controller
{
    // suggest recipes based on provided ingredients
   public function recipe_search(Request $request)
   {

      $recipes = collect();

      if(isset($request->ingredients)) {

        $recipe_ids = array();
        $ingredients = explode(",",$request->ingredients);
        $matching_ingredients = Ingredient::whereLike('name',$ingredients)->get(); //whereLike is a custom macro (App\Providers\AppServiceProvider)

        //count which recipe_id has the most pantry ingredients MATCH
        foreach ($matching_ingredients as $matching_ingredient) {
          if( !isset( $recipe_ids["{$matching_ingredient->recipe_id}"] ) ) {
            $recipe_ids["{$matching_ingredient->recipe_id}"] = 1;
          } else {
            $recipe_ids["{$matching_ingredient->recipe_id}"] = $matching_ingredient->recipe_id +1;
          }
        }

        arsort($recipe_ids); //this sorts the array putting thse with hieghest pantry ingredients MATCH at th top



        foreach ($recipe_ids as $recipe_id => $value) {
          $recipes->push(Recipe::find($recipe_id));
        }

// dd($recipes);

      }

      return RecipeResource::collection($recipes);

   }

}
