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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('reviews', 'ReviewController');
Route::get('/review-csv', 'ReviewController@csv_export')->name('export.csv');
//Route::get('/review-csv{key?}', 'ReviewController@csv_export')->name('export.csv');

Route::get('csv/practice1', 'CsvDownloadController@practice1'); //一覧表示
Route::get('csv/search', 'CsvDownloadController@search');       //検索
Route::get('csv/download1', 'CsvDownloadController@download1'); //ダウンロード

Route::resource('users', 'UserController');
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/zip', 'ReviewController@csvzip');
/* Route::get('/zip', function () {

	$files = glob(public_path().'svg/'); //(1)

	$zip = new ZipArchive(); //(2)

	$zip->open(public_path().'\sample.zip', ZipArchive::CREATE); //(3)

	foreach($files as $file){

		$file_info = pathinfo($file);

		$file_name = $file_info['filename'].'.'.$file_info['extension'];

		$zip->addFile($file, $file_name); //(4)

	}

	$zip->close(); //(5)

    return response()->download(public_path().'\sample.zip'); //(6)

}); */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
