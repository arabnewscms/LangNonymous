<?php
namespace Langnonymous\Lang;


use Illuminate\Support\ServiceProvider;
use Langnonymous\Lang\Lang;
use Illuminate\Support\Facades\Session;

class Langnonymous extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        if(!file_exists(base_path('config').'/langnonymous.php'))
        {
          $this->publishes([__DIR__.'/tools'=>base_path('config')]);   
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       
    }
}
