<?php

use App\Http\Controllers\ProductCachedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('product')->group(function () {
    Route::get("/show", [ProductController::class, 'show'])->name("show_product");
    Route::get("/list", [ProductController::class, 'list'])->name("list_products");
    Route::get("/create", [ProductController::class, 'create'])->name("create_product");
    Route::get("/edit", [ProductController::class, 'edit'])->name("edit_product");
    Route::get("/delete", [ProductController::class, 'delete'])->name("delete_product");
});

Route::prefix('cached/product')->group(function () {
    Route::get("/show", [ProductCachedController::class, 'show'])->name("show_product");
    Route::get("/list", [ProductCachedController::class, 'list'])->name("list_products");
    Route::get("/create", [ProductCachedController::class, 'create'])->name("create_product");
    Route::get("/edit", [ProductCachedController::class, 'edit'])->name("edit_product");
    Route::get("/delete", [ProductCachedController::class, 'delete'])->name("delete_product");
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

