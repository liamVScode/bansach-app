<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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
        //
        Paginator::useBootstrap();
        //truyen du lieu cho header o tat ca trang
        view()->composer('user.layout.header', function ($view) {
            $categories = DB::table('Category')
                ->select('CategoryID', 'CategoryName')
                ->take(5)
                ->get();

            $formattedCategories = [];

            //tim genre cho moi category
            foreach ($categories as $category) {
                $categoryId = $category->CategoryID;
                $categoryName = $category->CategoryName;

                $genres = DB::table('Genre')
                    ->where('CategoryID', $categoryId)
                    ->select('GenreID', 'GenreName')
                    ->take(5)
                    ->get();

                $formattedCategories[] = [
                    'id' => $categoryId,
                    'name' => $categoryName,
                    'genres' => $genres,
                ];
            }
            $view->with('formattedCategories', $formattedCategories);
        });


        view()->composer('user.product-category', function ($view) {
            $categories = DB::table('Category')
                ->select('CategoryID', 'CategoryName')
                ->take(5)
                ->get();

            $formattedCategories = [];

            //tim genre cho moi category
            foreach ($categories as $category) {
                $categoryId = $category->CategoryID;
                $categoryName = $category->CategoryName;

                $genres = DB::table('Genre')
                    ->where('CategoryID', $categoryId)
                    ->select('GenreID', 'GenreName')
                    ->take(5)
                    ->get();

                $formattedCategories[] = [
                    'id' => $categoryId,
                    'name' => $categoryName,
                    'genres' => $genres,
                ];
            }
            $view->with('formattedCategories', $formattedCategories);
        });


        view()->composer('user.product-category', function ($view) {
            $authors = DB::table('Book')
                ->select('Author')
                ->distinct()
                ->take(5)
                ->get();


            $view->with('authors', $authors);

        });

        view()->composer('user.product-category', function ($view) {
            $publisher = DB::table('Book')
                ->join('Publisher', "Book.PublisherID", "=", "Publisher.PublisherID")
                ->select('Publisher.PublisherID', 'PublisherName')
                ->distinct()
                ->take(5)
                ->get();


            $view->with('publisher', $publisher);
        });
    }
}
