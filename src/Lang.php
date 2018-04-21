<?php
namespace Langnonymous\Lang;

use App\Http\Controllers\Controller;

use Closure;

use Route;
use Session;

class Lang extends Controller {
	static $route;

	public static function Panel($routeAdmin = null) {
		if ($routeAdmin != null) {
			self::$route = $routeAdmin.'/';
		} else {
			self::$route = '';
		}
	}

	public function handle($request, Closure $next) {
		app()->setLocale(app('anonylang'));
		return $next($request);
	}

	public static function Main() {
		if (file_exists(base_path('config/langnonymous.php'))) {
			$langnonymous = config('langnonymous');

			Route::get($langnonymous['LangRoute'], function ($lang) {
					session()->put('anonylang', $lang);
					return $lang;
				});
		}
	}

	public static function put($set) {
		if (file_exists(base_path('config/langnonymous.php'))) {
			return self::$route.config('langnonymous.LangRoute').'/'.$set;
		}
	}

	public static function set($lang) {

		if (auth()->user() and config('langnonymous.UserModeLang') == true) {
			$user = auth()->user();
			if (in_array($lang, config('langnonymous.languages'))) {
				$user->{config('langnonymous.column_lang')} = $lang;
			} else {
				$user->{config('langnonymous.column_lang')} = config('langnonymous.defaultLanguage');
			}
			$user->save();

		} else {

			if (in_array($lang, config('langnonymous.languages'))) {
				session()->put('anonylang', $lang);
			} else {
				session()->put('anonylang', config('langnonymous.defaultLanguage'));
			}
		}

	}

	public static function LangNonymous() {
		Route::get(self::$route.config('langnonymous.LangRoute').'/{lang}', function ($lang) {

				self::set($lang);

				if (strtolower(config('langnonymous.redirectAfterSet')) == 'back') {
					return back();
				} else {
					return redirect(config('langnonymous.redirectAfterSet'));
				}
			});

		foreach (['lang', 'l', 'anonylang', 'direction', 'direct'] as $name) {
			app()->singleton($name, function () {
					return self::checklang();
				});
		}

		app()->singleton('dir', function () {if (self::checklang() == 'ar') {return 'rtl';} else {return 'ltr';}});
	}

	public static function checklang() {
		if (auth()->user() and config('langnonymous.UserModeLang') == true) {
			if (in_array(auth()->user()->{config('langnonymous.column_lang')}, config('langnonymous.languages'))) {
				return auth()             ->user()->{config('langnonymous.column_lang')};
			} else {
				config('langnonymous.defaultLanguage');
			}

		} elseif (session()->has('anonylang') and in_array(session()->get('anonylang'), config('langnonymous.languages'))) {
			return session()->get('anonylang');
		} else {
			return config('langnonymous.defaultLanguage');
		}
	}

	public static function dir() {
		if (self::checklang() == 'ar') {return 'rtl';} else {return 'ltr';}
	}

	public static function l() {
		return self::checklang();
	}

	public static function all() {
		return config('langnonymous.languages');
	}
}
