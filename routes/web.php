<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $users = \App\Models\User::where("email", "like", "%a@e%")
        ->orWhere("name", "like", "%Luc%")->limit(40)->get();

    $cryptedUsers = [];
    foreach ($users as $user) {
        $cryptedUsers[]['name'] = bcrypt($user->name);
        $cryptedUsers[]['email'] = bcrypt($user->email);
    }

    return response()->json($cryptedUsers);
});

Route::prefix('cached')->group(function () {
    Route::get('/test', function () {
        $encryptedUsers = cache()->remember('user_encrypted_data', 9999, function () {
            $users = \App\Models\User::where("email", "like", "%a@e%")
                ->orWhere("name", "like", "%Luc%")->limit(40)->get();

            $cryptedUsers = [];
            foreach ($users as $user) {
                $cryptedUsers[]['name'] = bcrypt($user->name);
                $cryptedUsers[]['email'] = bcrypt($user->email);
            }

            return $cryptedUsers;
        });
        return response()->json($encryptedUsers);
    });
});

