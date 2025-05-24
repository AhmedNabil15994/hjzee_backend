<?php

use App\Http\Controllers\Provider\AuthController;
use App\Http\Controllers\Provider\HomeController;
use App\Http\Controllers\Provider\UserController;
use App\Http\Controllers\Provider\ReservationController;
use App\Http\Controllers\Provider\PaymentsController;
use App\Http\Controllers\Provider\SettingsController;
use App\Http\Controllers\Provider\ContactUsController;
use App\Http\Controllers\Provider\NotificationsController;
use App\Http\Controllers\Provider\ForgotPasswordController;
use App\Http\Controllers\Provider\ResetPasswordController;
use App\Http\Controllers\Provider\ServiceController;
use App\Http\Controllers\Provider\PlaceController;


use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'provider','as' => 'provider.','middleware' => ['lang','web', 'HtmlMinifier']], function () {

    Route::get('loginForm/', [AuthController::class, 'loginForm'])->name('loginForm');
    Route::get('login/', [AuthController::class, 'loginForm'])->name('login');
    Route::post('provider-login/', [AuthController::class, 'providerLogin'])->name('providerLogin');

    Route::get('register/', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('providerRegister/', [AuthController::class, 'providerRegister'])->name('providerRegister');

    Route::get('forget-password/', [AuthController::class, 'forget_password'])->name('forget-password');
    Route::post('forgetPassword/', [AuthController::class, 'forgetPassword'])->name('forgetPassword');

    Route::get('forgetPassword', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class,'createReset'])->name('password.createReset');


    Route::group(['middleware'=>['provider-auth']],function(){
        Route::get('activationPage/', [AuthController::class, 'activationPage'])->name('activationPage');
        Route::post('activateAccount/', [AuthController::class, 'activateAccount'])->name('activateAccount');
    });

    Route::group(['middleware'=>['provider-auth']],function(){
        Route::get('index/', [HomeController::class, 'index'])->name('index');
        Route::get('profile/', [UserController::class, 'profile'])->name('profile');
        Route::get('editProfile/', [UserController::class, 'editProfile'])->name('editProfile');
        Route::put('updateProfile/', [UserController::class, 'updateProfile'])->name('updateProfile');
        Route::get('editPassword/', [UserController::class, 'editPassword'])->name('editPassword');
        Route::post('updatePassword/', [UserController::class, 'updatePassword'])->name('updatePassword');


        Route::get('add-service/', [ServiceController::class, 'addService'])->name('addService');
        Route::post('create-service/', [ServiceController::class, 'createService'])->name('createService');
        Route::get('edit-service/{service}', [ServiceController::class, 'editService'])->name('editService');
        Route::put('update-service/{service}', [ServiceController::class, 'updateService'])->name('updateService');
        Route::get('service-details/{service}', [ServiceController::class, 'serviceDetails'])->name('serviceDetails');
        Route::delete('delete-service/{service}', [ServiceController::class, 'deleteService'])->name('deleteService');
        Route::post('delete-image/', [ServiceController::class, 'deleteImage'])->name('deleteImage');

        Route::get('add-place/', [PlaceController::class, 'addPlace'])->name('addPlace');
        Route::post('create-place/', [PlaceController::class, 'createPlace'])->name('createPlace');
        Route::get('edit-place/{place}', [PlaceController::class, 'editPlace'])->name('editPlace');
        Route::put('update-place/{place}', [PlaceController::class, 'updatePlace'])->name('updatePlace');
        Route::get('place-details/{place}', [PlaceController::class, 'placeDetails'])->name('placeDetails');
        Route::delete('delete-place/{place}', [PlaceController::class, 'deletePlace'])->name('deletePlace');
        Route::post('delete-place-image/', [PlaceController::class, 'deleteImage'])->name('deletePlaceImage');

        Route::put('update-employee/{employee}', [UserController::class, 'updateEmployee'])->name('updateEmployee');
        Route::post('create-employee/', [UserController::class, 'createEmployee'])->name('createEmployee');

        Route::post('create-reservation/', [ReservationController::class, 'createReservation'])->name('createReservation');
        Route::post('create-service-reservation/', [ReservationController::class, 'createServiceReservation'])->name('createServiceReservation');
        Route::put('update-reservation/{order}', [ReservationController::class, 'updateReservation'])->name('updateReservation');
        Route::put('update-service-reservation/{order}', [ReservationController::class, 'updateServiceReservation'])->name('updateServiceReservation');
        
        Route::post('searchNewReservation/', [ReservationController::class, 'searchNewReservation'])->name('searchNewReservation');
        Route::post('searchFinishedReservation/', [ReservationController::class, 'searchFinishedReservation'])->name('searchFinishedReservation');
        Route::post('searchReservation/', [ReservationController::class, 'searchReservation'])->name('searchReservation');
        

        Route::group(['middleware'=>['CheckProviderRole']],function(){
            // reservations
            Route::get('add-place-reservation/', [ReservationController::class, 'addPlaceReservation'])->name('addPlaceReservation');
            Route::get('edit-place-reservation/{order}', [ReservationController::class, 'editPlaceReservation'])->name('editPlaceReservation');
            Route::get('reservation-place-details/{order}', [ReservationController::class, 'reservationPlaceDetails'])->name('reservationPlaceDetails');
            Route::delete('delete-reservation/{order}', [ReservationController::class, 'deleteReservation'])->name('deleteReservation');

            
            Route::get('add-service-reservation/', [ReservationController::class, 'addServiceReservation'])->name('addServiceReservation');
            Route::get('edit-service-reservation/{order}', [ReservationController::class, 'editServiceReservation'])->name('editServiceReservation');
            Route::get('reservation-service-details/{order}', [ReservationController::class, 'reservationServiceDetails'])->name('reservationServiceDetails');
            Route::get('reservations/', [ReservationController::class, 'reservations'])->name('reservations');
            Route::get('new/', [ReservationController::class, 'new'])->name('new');
            Route::get('finished/', [ReservationController::class, 'finished'])->name('finished');
           
            Route::get('payments/', [PaymentsController::class, 'index'])->name('payments');

            Route::get('employees/', [UserController::class, 'employees'])->name('employees');
            Route::get('add-employee/', [UserController::class, 'addEmployee'])->name('addEmployee');
            Route::get('edit-employee/{employee}', [UserController::class, 'editEmployee'])->name('editEmployee');
            Route::get('employee-details/{employee}', [UserController::class, 'employeeDetails'])->name('employeeDetails');
            Route::delete('delete-employee/{employee}', [UserController::class, 'deleteEmployee'])->name('deleteEmployee');
       
            Route::get('services/', [ServiceController::class, 'services'])->name('services');
            Route::get('places/', [PlaceController::class, 'places'])->name('places');


        });
        
        //start ajax
        Route::get('get-provider-available-times', [ReservationController::class,'getProviderAvailableTimes'])->name('get-provider-available-times');
        Route::get('get-place-meeting-rooms', [ReservationController::class,'getPlaceMeetingRooms'])->name('get-place-meeting-rooms');

        //end ajax

        Route::get('notifications/', [NotificationsController::class, 'index'])->name('notifications');
        Route::delete('delete-notifications', [NotificationsController::class, 'deleteNotifications'])->name('delete-notifications');

        Route::get('contactus/', [ContactUsController::class, 'index'])->name('contactus');
        Route::get('settings/', [SettingsController::class, 'index'])->name('settings');
        Route::post('changeLang/', [SettingsController::class, 'changeLang'])->name('changeLang');

        Route::post('logout-provider/', [AuthController::class, 'logoutProvider'])->name('logoutProvider');

    });

});

