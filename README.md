# Simple Translate  Package
A Simple Translate To convert ui and local language. Developed By PhpAnonymous ( phpanonymous.com )
Laravel Version 5 and Above 
##Install with Composer 
```php
composer require Langnonymous/Lang:dev-master
```
# Provider Class 
put on your ` config/app.php ` in provider array this class
```php
  Langnonymous\Lang\Langnonymous::class,
 
```

#Aliases 
add this in aliases array
```php 
'L'         => Langnonymous\Lang\Lang::class,
```
#publish 
with composer run this command `php artisan vendor:publish `

now you can check this file langnonymous.php on config path 

you should add this middleware in kernel.php file 
```php
'Lang'     => \Langnonymous\Lang\Lang::class,

// like This 
  protected $routeMiddleware = [        
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'Lang'     => \Langnonymous\Lang\Lang::class,
    ];
```




#usage 

you can use The L Class anywhere you want it , in Controller or Blade File 

Now You should add this method to web.php or any route file to fire our operators
```php
L::LangNonymous();
```
do you have admin panel and you want access route path to lang ? 
add this in route files if you want and set path like admin !! 
```php
L::Panel('admin');

```

now you are ready to see your route like this 
It is preferable to place these lines in the first line of the file
```php 
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

L::Panel('admin');
L::LangNonymous();
```

okay You have to add this public middleware and you have Put all your routes inside this middelware 

```php
Route::group(['middleware'=>'Lang'],function(){
// put all routes here please ...i'ts fine :)
});
```
now you maybe want configuer your file langnonymous 
```php
<?php 

return [
		'UserModeLang'=>true, // true,false | if you want save lang in User Tbl Set true auto detected user lang
		'LangRoute'=>'langnonymous', // Route Name You Can Change Route Name
		'column_lang'=>'lang', // You May put The Defualt column if you are enable UserModeLang for true
		'languages'=>['ar','en','es','jp'], // Put Your Language website Usage
		'defaultLanguage'=>'ar', // Set Your Default Language (ar,en,es Any Short Lang From languages array)
		'redirectAfterSet'=>'back', //Set Direction home,back | Back reflect to function back | home to index or other route
];

```
this is methods and classess built in package you can use all form any where
```php

app('lang');
app('l');
// if you want methods !! okay that's was easy
L::lang();
L::l();
// master session 
session('anonylang');
// you have a style directions !! don't worry
// use this singletone in your file css or js :) whatever like example.com/css/style-rtl.css :) or rtl
app('dir'); // RTL OR LTR
L::dir(); // RTL or LTR
//example.com/css/style-{{app('dir')}}.css from link tag
//example.com/js/jquery-{{app('dir')}}.css from script tag 

// attention 
//if you are enable UserModeLang .. you should add column name to column_lang from user table in sql 
// you maybe make a new folders to usage this array 'languages'=>['ar','en','es','jp']
/*
resource/lang/ar
set file name and put this array
<?php 
return [
		'ar'=>'العربية',
		'en'=>'English',
		'es'=>'Spanish',
		'jp'=>'日本の',
		'welcome'=>'مرحبا',
	];
   demo trans('yourfile.welcome') // مرحبا
  
resource/lang/en
set file name and put this array
<?php 
return [
		'ar'=>'العربية',
		'en'=>'English',
		'es'=>'Spanish',
		'jp'=>'日本の',
		'welcome'=>'Welcome',
	];
   demo trans('yourfile.welcome') // welcome
resource/lang/es
set file name and put this array
<?php 
return [
		'ar'=>'العربية',
		'en'=>'English',
		'es'=>'Spanish',
		'jp'=>'日本の',
		'welcome'=>'bienvenida',
	];
   demo trans('yourfile.welcome') // bienvenida
resource/lang/jp
set file name and put this array
<?php 
return [
		'ar'=>'العربية',
		'en'=>'English',
		'es'=>'Spanish',
		'jp'=>'日本の',
		'welcome'=>'もしもし',
	];
  demo trans('yourfile.welcome') // もしもし
or you can custom any language needed want
*/

// to set lang on your web okay follow this 
// in blade file put master language 
<a href="{{L::put('ar')}}">{{trans('yourfile.ar')}}</a>
<a href="{{L::put('en')}}">{{trans('yourfile.en')}}</a>
<a href="{{L::put('es')}}">{{trans('yourfile.es')}}</a>
<a href="{{L::put('jp')}}">{{trans('yourfile.jp')}}</a>
// or you can loop all automatically with method L::all();
@foreach(L::all() as $lang)
                            <a href="{{L::put($lang)}}">{{trans('yourfile.'.$lang)}}</a> . 
                 @endforeach
// for singleton 

```

  
if you have any questions about this package join us on group facebook  (https://www.facebook.com/groups/anonymouses.developers) 

Enjoy :) 


