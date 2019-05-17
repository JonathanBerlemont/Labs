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

Route::get('/home', 'HomeController@index')->name('home');

// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');


/* Admin Routes */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });

    Route::get('/admin', function () {
        return view('admin.main');
    });


    /* Blogs */
    Route::get('/admin/blog', 'BlogsController@adminIndex');
    Route::get('/admin/blog/create', function() {
        return view('admin.blog.create');
    });
    Route::post('admin/blog', 'BlogsController@store');
    Route::get('/admin/blog/{blog}', 'BlogsController@adminShow');
    Route::patch('/admin/blog/{blog}', 'BlogsController@update');
    Route::delete('/admin/blog/{blog}', 'BlogsController@destroy');
    

    /* Comments */
    Route::delete('/comments/{comment}','CommentsController@destroy');


    /* Users */
    Route::get('/admin/users', 'UsersController@index');
    Route::delete('/admin/users/{user}', 'UsersController@destroy');
    Route::get('/admin/users/create', 'UsersController@create');
    Route::post('/admin/users/create', 'UsersController@store');
    Route::get('/admin/users/{user}', 'UsersController@show');
    Route::patch('/admin/users/{user}', 'UsersController@update');
    Route::patch('/admin/users/{user}/role', 'UsersController@updateRole');


    /* Services */
    Route::get('/admin/services', 'ServicesController@adminIndex');
    Route::get('/admin/services/create', 'ServicesController@create');
    Route::get('/admin/services/{service}', 'ServicesController@show');
    Route::post('/admin/services', 'ServicesController@store');
    Route::patch('/admin/services/{service}', 'ServicesController@update');
    Route::delete('/admin/services/{service}', 'ServicesController@destroy');


    /* Project */
    Route::get('/admin/projects', 'ProjectsController@index');
    Route::post('/admin/projects', 'ProjectsController@store');
    Route::get('/admin/projects/create', 'ProjectsController@create');
    Route::get('/admin/projects/{project}', 'ProjectsController@show');
    Route::patch('/admin/projects/{project}', 'ProjectsController@update');
    Route::delete('/admin/projects/{project}', 'ProjectsController@destroy');


    /* Contact */
    Route::get('/admin/contact', function() {
        return view('admin.contact.main');
    });
    Route::post('/admin/contact', 'UpdateContact@update');
    Route::get('/admin/mails/{mail}', 'MailsController@show');
    Route::delete('/admin/mails/{mail}', 'MailsController@destroy');


    /* Team */
    Route::get('/admin/team', 'TeamsController@index');
    Route::post('/admin/team', 'TeamsController@store');
    Route::get('/admin/team/create', 'TeamsController@create');
    Route::patch('/admin/team/{member}', 'TeamsController@update');
    Route::get('/admin/team/{member}', 'TeamsController@show');
    Route::delete('/admin/team/{member}', 'TeamsController@destroy');

    /* Newsletter */
    Route::get('/admin/newsletter', 'NewslettersController@index');
    Route::get('/admin/newsletter/send', 'NewslettersController@sendNewsletter');
    Route::delete('/admin/newsletter/{id}', 'NewslettersController@destroy');


    /* Testimonials */
    Route::get('/admin/testimonials', 'TestimonialsController@index');
    Route::post('/admin/testimonials', 'TestimonialsController@store');
    Route::delete('/admin/testimonials/{testimonial}', 'TestimonialsController@destroy');

});

/* Blogs */
Route::get('/blog', 'BlogsController@index');
Route::get('/blog/{blog}', 'BlogsController@show');

/* Comments */
Route::post('/blog/{blog}/comment', 'CommentsController@store');

/* Tags */
Route::get('/blog/tags/{tag}', 'TagsController@show');

/* Categories */
Route::get('/blog/categories/{category}', 'CategoriesController@show');

/* Search Bar*/
Route::post('/blog/search', function () {
    $query = request()['query'];
    $blogs = App\Blog::where('title', 'like', "%$query%")->orWhere('description', 'like', "%$query%")->paginate(3);

    return view('blog.index', compact('blogs'));
});

/* Services */
Route::get('/services', 'ServicesController@index');

/* Client Sending Mails */
Route::post('/mails', 'MailsController@sendMailToOwner');

/* Subscribe to Newsletter */
Route::post('/newsletter', 'NewslettersController@store');

/* Contact */
Route::get('/contact', function() {
    return view('contact');
});