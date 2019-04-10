<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;

use App\Recipe;
use App\Ingredient;
use App\Instruction;

class WebScrapperController extends Controller
{
    // category page
    // eg -->  http://www.kitchenbowl.com/recipes/English
    function get_category_recipes()
    {
      $categorie_urls = [
        // 'http://www.kitchenbowl.com/recipes/French',
        // 'http://www.kitchenbowl.com/recipes/Barbecue',
        // 'http://www.kitchenbowl.com/recipes/Vegetables',
        // 'http://www.kitchenbowl.com/recipes/Rice',
        // 'http://www.kitchenbowl.com/recipes/Noodles',
        // 'http://www.kitchenbowl.com/recipes/Baked%20Goods',
        // 'http://www.kitchenbowl.com/recipes/Breakfast%20&%20Brunch',
        // 'http://www.kitchenbowl.com/recipes/Thanksgiving',
        // 'http://www.kitchenbowl.com/recipes/Soups'
      ];

        $client = new Client();
        foreach ($categorie_urls as $categorie_url) {
          //get page links
          $crawler = $client->request('GET', $categorie_url );
          $recipe_page_links = $crawler->filter('#items >  .masonry-brick > a')->extract('href');
          //get recipe
          foreach ($recipe_page_links as $recipe_page_link) {
            $this->scrap( 'http://www.kitchenbowl.com'.$recipe_page_link );
          }
          dump(count($recipe_page_links)." DONE ". $categorie_url);
          dump("*********************");
        }

    }

    public function scrap( $page_url ) //can take array of page links to scrap
    {

        $client = new Client();
        $crawler = $client->request('GET', $page_url);  // Go to the website

        $recipe_name = $crawler->filter('#summary > h1 ')->text();
        $image = $crawler->filter('.img-responsive , .justCenterIt')->attr('src');
        $serves = $crawler->filter('#ingredients > .content-text > h5 ')->text();
        $cook_time = $crawler->filter('#summary > .row  div:nth-of-type(2) .time')->text();
        $ingredients = [];
        $instructions = [];
        $instructions_image_link = [];
        //get ingredients
        $crawler->filter('#ingredients  [itemprop="ingredients"]')->each(function ($node) use ( &$ingredients ){
            $ingredients[] = $node->text();
        });
        //get instructions
        $crawler->filter('#instructions  [itemprop="recipeInstructions"]')->each(function ($node) use ( &$instructions , &$instructions_image_link ){
            $instructions[] = $node->text();
        });
        //get instructions images
        $crawler->filter('#instructions  #ugc_image ,#instructions source')->each(function ($node) use ( &$instructions_image_link ){
            $instructions_image_link[] = $node->attr('src');
        });


        $recipe = new Recipe;
        $recipe->name = $recipe_name;
        $recipe->image = $image;
        $recipe->serves = $serves;
        $recipe->cook_time = $cook_time;
        $recipe->save();

        foreach ($ingredients as $ingredient) {
          $recipe_ingred = new Ingredient;
          $recipe_ingred->recipe_id = $recipe->id;
          $recipe_ingred->name = $ingredient;
          $recipe_ingred->save();

        }

        foreach ($instructions as $key => $instruction) {
          $recipe_instru = new Instruction;
          $recipe_instru->recipe_id = $recipe->id;
          $recipe_instru->step = $key + 1;
          $recipe_instru->image = $instructions_image_link[$key];
          $recipe_instru->text = $instruction;
          $recipe_instru->save();

        }

          // dump($recipe);
          // dump("----");
          // dump(Ingredient::all());
          // dump("----");
          // dump(Instruction::all());


    }
}
