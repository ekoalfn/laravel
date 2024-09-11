<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Models\Country;
use App\Models\Student;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
Route::get('/login', function () {
    return 'P';
})->name('login');
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
// Route::get('/attach', function(){
//     $student = Student::find(1);

//     // $student->extra()->attach(1);

//     $student->extra()->sync(2);  // Untuk mengatasi duplikasi data dari penggunaan metode attach
// });

// Route::get('/detach', function(){
//     $student = Student::find(1);

//     $student->extra()->detach([3,4]);
// });

// // // Laravel scout // // //
Route::get('/book', [BookController::class, 'index'])->name('book');

// // // Reset Password // // //
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
