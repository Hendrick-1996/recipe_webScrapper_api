<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Builder::macro('whereLike', function(string $attribute,  $searchTerms) {


        $this->where(function (Builder $query) use ($attribute, $searchTerms) {
          foreach(array_wrap($searchTerms) as $searchTerm) {
             $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
          }
         });

        return $this;

      });
    }
}
