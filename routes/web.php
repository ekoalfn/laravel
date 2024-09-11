<?php

use App\Models\Country;
use App\Models\Student;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// //Email Verification // //
// Route::get('/login', function(){
//     return 'P';
// })->name('login');
// Route::get('/register', [AuthController::class, 'register']);
// Route::post('/register', [AuthController::class, 'registerproses'])->name('register');
// Route::get('/email/verify', function(){
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect('/profile');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::get('/profile', function () {
//     return 'profile';
// })->middleware(['auth', 'verified']);


// Upsert
// Route::get('/countries', function(){
//     $country = Country::updateOrCreate(
//         ['name' => 'singapura'], //Kolom untuk pengecekan data
//         [
//             'name' => 'singapura', //Data yang akan diupdate
//             'capital_city' => 'singapura',
//             'currency' => 'dollar s'
//         ]
//     );
// });



// // Attach Detach // //
Route::get('/attach', function(){
    $student = Student::find(1);

    // $student->extra()->attach(1);

    $student->extra()->sync(2);  // Untuk mengatasi duplikasi data dari penggunaan metode attach
});

Route::get('/detach', function(){
    $student = Student::find(1);

    $student->extra()->detach([3,4]);
});