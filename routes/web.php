<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Url;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/', function (Request $request) {
	
	function uniqstring($id) {
		$b = $id;
		$c = '';
		$a = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
		while ($b > 0) {
			$c = $c.$a[$b % count($a)];
			$b = intdiv($b, count($a));
		}
		return $c;
	}
	
	if (!filter_var($request->url, FILTER_VALIDATE_URL)) return Redirect::back();
	if (strpos(strtolower($request->url), config('app.url')) !== false) return Redirect::back();
	
	$url = new Url();
	$url->url = $request->url;
	$url->name = '-1';
	$url->save();
	$url->name = uniqstring($url->id + 10000);
	$url->save();
	return redirect()->to(route('home'))->with(['url' => $url->name ]);
	
})->name('create_new_short_link');

Route::get('/s/{name}', function ($name) {
	$r = Url::where('name', $name)->first();
	if ($r) return Redirect::to($r->url);
	return redirect()->to(route('home'));
})->name('short');