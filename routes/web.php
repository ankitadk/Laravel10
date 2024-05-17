<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Profile\AvatarController;
use OpenAI\Laravel\Facades\OpenAI;

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

Route::get('/', function () {
    return view('welcome');
    //fetch all users
    // $users = DB::select("select * from users");
    // $users = DB::table("users")->where("id", 1)->get();
    // $users = User::find(6);

    // create new user
    // $user = DB::insert("insert into users (name, email, password) values (?, ?, ?)", ['Sarthak1', 'Sarthak1@bitfumes.com', 'password']);
    // $user = DB::table("users")->insert([
    //     "name" => "Sarthak2",
    //     "email" => "sarthak2@email.com",
    //     "password" => "password"
    // ]);
    // $user = User::create([
    //     "name" => "Sarthak6",
    //     "email" => "sarthak6@gmail.com",
    //     "password" => "pass6",
    // ]);

    // update a user
    // $user = DB::update("update users set email = ? where id = ?", ['sarthak@bitfumes.com', 2]);
    // $user = DB::table("users")->where("id", 1)->update(["email" => "sabc@bifumes.com"]);
    // $user = User::where("id", 8)->update([
    //     "email" => "abc@gmail.com",
    // ]);

    // delete a user
    // $user = DB::delete("delete from users where id = ?", ['2']);
    // $user = DB::table("users")->where("id", 3)->delete();
    // $user = User::where("id", 8)->delete();
    // $users = User::truncate();

    // dd($users->name);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/openai', function () {
    $result = OpenAI::completions()->create([
        // 'model' => 'text-davinci-003',
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'PHP is',
    ]);

    echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
});