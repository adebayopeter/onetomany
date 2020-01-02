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

use App\User;
use App\Post;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/createpost/{userid}', function($userid) {

    $user = User::findOrFail($userid);

    $post = new Post([
        'title' => 'My Third Post with Adebayo',
        'body' => 'Body of my third post'
    ]);

    $user->posts()->save($post);

});

Route::get('/read/{id}', function($id) {

    $user = User::findOrFail($id);

    foreach($user->posts as $post) {

        echo '<strong>' . $post->title . '</strong> ===== ' . $post->body . '<br>';

    }

});

Route::get('/update/{user_id}/{post_id}', function($user_id, $post_id) {

    $user = User::find($user_id);

    $user->posts()->whereId($post_id)->update(['title' => 'Updated title', 'body' => 'Updated ccontent!']);

});

Route::get('/delete/{user_id}/{post_id}', function($user_id, $post_id) {

    $user = User::find($user_id);

    $user->posts()->whereId($post_id)->delete();

});

// Reverse of OneToMany
Route::get('/read2/{post_id}', function($post_id) {

    $post = Post::find($post_id);

    return $post->user->name;

});