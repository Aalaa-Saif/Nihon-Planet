<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\CityController;
use App\Http\Controllers\Main\FoodController;
use App\Http\Controllers\Main\NihonController;
use App\Http\Controllers\Main\ClothsController;
use App\Http\Controllers\Main\AdvertisementController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AuthController\User\LoginController;
use App\Http\Controllers\AuthController\User\LogoutController;
use App\Http\Controllers\AuthController\User\RegisterController;
use App\Http\Controllers\AuthController\User\UserAuthController;
use App\Http\Controllers\AuthController\Admin\AdminAuthController;
use App\Http\Controllers\AuthController\Admin\AdminLoginController;
use App\Http\Controllers\AuthController\Admin\AdminLogoutController;
use App\Http\Controllers\AuthController\Admin\AdminRegisterController;


//Route::get('/', function () {
    //return view('welcome');
//});

Auth::routes(['verify'=>true]);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



################################# Admin #################################
Route::group(['namespace' => 'Main'], function() {

    // Middleware For Admins //
    Route::group(['middleware'=>'auth:admin'],function(){

         // Advertisement Controller (Admin) //
        Route::get('ad create',[AdvertisementController::class,'create']); //For add Advertisement
        Route::post('ad store',[AdvertisementController::class,'store'])->name('ad_store');
        Route::get('ad all',[AdvertisementController::class,'adAll']);
        Route::get('ad edit/{id}',[AdvertisementController::class,'edit'])->name('ad_edit');
        Route::post('ad update',[AdvertisementController::class,'update'])->name('ad_update');
        Route::post('ad delete',[AdvertisementController::class,'delete'])->name('ad_delete');


        // Food Controller (Admin) //
        Route::get('food create',[FoodController::class,'create']);
        Route::post('food store',[FoodController::class,'store'])->name('food_store');
        Route::get('food all',[FoodController::class,'foodAll']);
        Route::get('food edit/{food_id}',[FoodController::class,'edit'])->name('food_edit');
        Route::post('food update',[FoodController::class,'update'])->name('food_update');
        Route::post('food delete',[FoodController::class,'delete'])->name('food_delete');


        // City Controller (Admin) //
        Route::get('city create',[CityController::class,'cityCreate']);
        Route::post('city store',[CityController::class,'store'])->name('city_store');
        Route::get('city all',[CityController::class,'cityAll']);
        Route::get('city edit/{city_id}',[CityController::class,'edit'])->name('city_edit');
        Route::post('city update',[CityController::class,'update'])->name('city_update');
        Route::post('city delete',[CityController::class,'delete'])->name('city_delete');
        Route::post('city deleteimg',[CityController::class,'city_deleteimg'])->name('city_deleteimg');


        // Cloths Controller (Admin) //
        Route::get('cloths create',[ClothsController::class,'clothsCreate']);
        Route::post('cloths store',[ClothsController::class,'store'])->name('cloths_store');
        Route::get('cloths all',[ClothsController::class,'clothsAll']);
        Route::get('cloths edit/{cloths_id}',[ClothsController::class,'edit'])->name('cloths_edit');
        Route::post('cloths update',[ClothsController::class,'update'])->name('cloths_update');
        Route::post('cloths delete',[ClothsController::class,'delete'])->name('cloths_delete');


        // Nihon Controller (Admin) //
        Route::get('nihon all',[NihonController::class,'nihonAll']);
        Route::get('nihon create',[NihonController::class,'nihonCreate']);
        Route::get('nihon store',[NihonController::class,'nihonStore'])->name('nihon_store');
        Route::get('nihon edit/{id}',[NihonController::class,'edit'])->name('nihon_edit');
        Route::post('nihon update',[NihonController::class,'update'])->name('nihon_update');
        Route::post('nihon delete',[NihonController::class,'delete'])->name('nihon_delete');
    });

    // Blade -> Languages (en,ar)
    Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function(){

        // Nihon Controller //
        Route::get('main page',[NihonController::class,'nihon'])->name('nihon');
        Route::get('get nihon',[NihonController::class,'getNihon'])->name('get_nihon');

        // City Controller //
        Route::get('city',[CityController::class,'city'])->name('city');
        Route::get('get city',[CityController::class,'getCity'])->name('get_city');

        // Cloths Controller //
        Route::get('cloths',[ClothsController::class,'cloths'])->name('cloths');
        Route::get('get cloths',[ClothsController::class,'getCloths'])->name('get_cloths');

        // Food Controller //
        Route::get('food',[FoodController::class,'food'])->name('food');
        Route::get('get food',[FoodController::class,'getFood'])->name('get_food');

    });
});
##############################################################################





Route::group(['namespace' => 'AuthController'], function() {
    ############################ Admin #############################
    Route::group(['namespace' => 'Admin'], function() {
        // Admin Register Controller //
        //Route::get('admin register',[AdminRegisterController::class,'register'])->name('admin_register');
        //Route::post('admin store',[AdminRegisterController::class,'store'])->name('admin_store');

        // Admin Login Controller //
        Route::post('admin check',[AdminLoginController::class,'admin_check'])->name('admin_check');
        Route::get('admin login',[AdminLoginController::class,'login'])->name('admin_login');

        // Admin Logout Controller //
        Route::get('admin logout',[AdminLogoutController::class,'logout']);

        // Middleware For Admins //
        Route::group(['middleware'=>'auth:admin'],function(){
            // Admin Auth Controller //
            Route::get('admin dashboard',[AdminAuthController::class,'admin_dashboard'])->name('admin_dashboard');
            Route::post('admin update profile',[AdminAuthController::class,'update'])->name('admin_update_profile');
        });

        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
        function(){

             // Admin Login Controller //
             Route::get('admin login',[AdminLoginController::class,'login'])->name('admin_login');
        });
    });
    ############################ End Admin #############################


    ############################## User ###############################
    Route::group(['namespace' => 'User'], function() {
        // Blade -> Languages (en,ar) //
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
        function(){

            // User Register Controller //
            Route::get('otaku register',[RegisterController::class,'register'])->name('otaku_register');;
            Route::post('otaku store',[RegisterController::class,'store'])->name('otaku_store');

            // User Login Controller //
            Route::get('otaku login',[LoginController::class,'login'])->name('otaku_login');
            Route::post('otaku check',[LoginController::class,'login_check'])->name('login_check');

            // User Logout Controller //
            Route::get('otaku logout',[LogoutController::class,'logout']);

            // Middleware For Users //
            Route::group(['middleware'=>['auth','verified']],function(){
                ////User Dashboard Controller////
                Route::get('otaku profile',[UserAuthController::class,'profile'])->name('o_profile');
                Route::get('post',[UserAuthController::class,'post'])->name('post');
                Route::post('post store',[UserAuthController::class,'post_store'])->name('post_store');
                Route::post('comment store',[UserAuthController::class,'comment_store'])->name('comment_store');
                Route::post('post delete',[UserAuthController::class,'delete'])->name('post_delete');
                Route::post('profile update',[UserAuthController::class,'updateProfilePhoto'])->name('profile_photo_update');

            });

        });
    });
    ################################## End User ##################################

});

