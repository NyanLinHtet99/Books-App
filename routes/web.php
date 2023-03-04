<?php

use App\Models\User;

use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/image', function () {
    request()->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
    ]);

    $userId = auth()->user()->id;
    $user = User::find($userId);
    $imageName = $userId . '.' . request('image')->extension();
    $path = request('image')->storeAs(
        'avatars',
        $imageName,
        'public'
    );

    if ($user->info === null) {
        $user->info()->save(new UserInfo(['image' => $imageName])); // trigger created event
        // $user->info()->create($input);// trigger created event
    } else {
        $user->info->update(['image' => $imageName]); // trigger updated event
        // $user->info()->update($input); // will NOT trigger updated event
    }

    return back()
        ->with('success', 'You have successfully upload image.')
        ->with('image', $imageName);
})->name('image.store');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
