<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Actions\Responses\LoginResponse as CustomLoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Actions\Responses\RegisterResponse as CustomRegisterResponse;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
       // fetch categories from the database
        view()->composer('user.navbar', function ($view) {
            $view->with('categories', Category::with('subcategories')->get());
        });
        view()->composer('user.navbar', function ($view) {
            $subcategories = Subcategory::orderBy('created_at','desc')->take(4)->get();
            $view->with('subcategories', $subcategories);
             });
             view()->composer('user.index', function ($view) {
                 $view->with('categories', Category::withCount('products')->take(6)->get());
             });
           view()->composer('user.navbar', function ($view) {
            $json = Storage::disk('public')->get('pakistan_cities.json');
            $data = json_decode($json, true);
         //   dd(Storage::disk('public')->get('pakistan_cities.json'));
            $cities = collect($data['states'])
                        ->flatMap(fn($state) => $state['cities'])
                        ->values();
            
            $view->with('cities', $cities);
            
                  $view->with('cities', $cities);
                });
           
            }
}
