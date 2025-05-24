<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'admin',
    'namespace'  => 'Admin',
    'as'         => 'admin.',
    'middleware' => ['web-cors'],
], function () {

    Route::get('/lang/{lang}', 'AuthController@SetLanguage');

    Route::get('login', 'AuthController@showLoginForm')->name('show.login')->middleware('guest:admin');
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('logout', 'AuthController@logout')->name('logout');
    
    Route::get('forget-password', 'AuthController@showForgetPasswordForm')->name('show.forget-password');
    Route::post('forget-password', 'AuthController@forgetPassword')->name('forget-password');


    Route::get('resert-password/{admin}', 'AuthController@showResetPasswordForm')->name('show.reset-password');
    Route::post('reset-password', 'AuthController@resetPassword')->name('reset-password');

    Route::post('getCities', 'CityController@getCities')->name('getCities');

    Route::get('user_complaints/{id}', [
        'uses'  => 'ClientController@showfinancial',
        'as'    => 'user_complaints.show',
        'title' => 'the_resolution_of_complaining_or_proposal',
    ]);

    Route::get('user_orders/{id}', [
        'uses'  => 'ClientController@showorders',
        'as'    => 'user_orders.show',
        'title' => 'orders',
    ]);

    Route::post('getMonthsReservationChart/', [
        'uses'  => 'HomeController@getMonthsReservationChart',
        'as'    => 'getMonthsReservationChart',
        'title' => 'getMonthsReservationChart',
    ]);
    Route::group(['middleware' => ['admin', 'check-role', 'admin-lang']], function () {
        /*------------ start Of profile----------*/
        Route::get('profile', [
            'uses'      => 'HomeController@profile',
            'as'        => 'profile',
            'title'     => 'profile',
            'sub_route' => true,
            'type'      => 'parent',
            'child'     => ['profile.update_password', 'profile.update'],
        ]);

        Route::put('profile-update', [
            'uses'  => 'HomeController@updateProfile',
            'as'    => 'profile.update',
            'title' => 'update_profile',
        ]);
        Route::put('profile-update-password', [
            'uses'  => 'HomeController@updatePassword',
            'as'    => 'profile.update_password',
            'title' => 'update_password',
        ]);
        /*------------ end Of profile----------*/

        /*------------ start Of Dashboard----------*/
        Route::get('dashboard', [
            'uses'      => 'HomeController@dashboard',
            'as'        => 'dashboard',
            'icon'      => '<i class="feather icon-home"></i>',
            'title'     => 'main_page',
            'sub_route' => false,
            'type'      => 'parent',
        ]);
        /*------------ end Of dashboard ----------*/

        /*------------ start Of intro site  ----------*/
        // Route::get('intro-site', [
        //     'as'        => 'intro_site',
        //     'icon'      => '<i class="feather icon-map"></i>',
        //     'title'     => 'introductory_site',
        //     'type'      => 'parent',
        //     'sub_route' => true,
        //     'child'     => [
        //         'intro_settings.index', 'introsliders.show', 'introsliders.index', 'introsliders.store', 'introsliders.update', 'introsliders.delete', 'introsliders.deleteAll', 'introsliders.create', 'introsliders.edit',
        //         'introservices.show', 'introservices.index', 'introservices.create', 'introservices.store', 'introservices.edit', 'introservices.update', 'introservices.delete', 'introservices.deleteAll',
        //         'introfqscategories.show', 'introfqscategories.index', 'introfqscategories.store', 'introfqscategories.create', 'introfqscategories.edit', 'introfqscategories.update', 'introfqscategories.delete', 'introfqscategories.deleteAll',
        //         'introfqs.show', 'introfqs.index', 'introfqs.store', 'introfqs.update', 'introfqs.delete', 'introfqs.deleteAll', 'introfqs.edit', 'introfqs.create',
        //         'introparteners.create', 'introparteners.show', 'introparteners.index', 'introparteners.store', 'introparteners.update', 'introparteners.delete', 'introparteners.deleteAll',
        //         'intromessages.index', 'intromessages.delete', 'intromessages.deleteAll', 'intromessages.show',
        //         'introsocials.show', 'introsocials.index', 'introsocials.store', 'introsocials.update', 'introsocials.delete', 'introsocials.deleteAll', 'introsocials.edit', 'introsocials.create',
        //         'introparteners.edit', 'introhowworks.show', 'introhowworks.index', 'introhowworks.store', 'introhowworks.update', 'introhowworks.delete', 'introhowworks.deleteAll', 'introhowworks.create', 'introhowworks.edit',
        //     ],
        // ]);

        // Route::get('intro-settings', [
        //     'uses'  => 'IntroSetting@index',
        //     'as'    => 'intro_settings.index',
        //     'title' => 'introductory_site_setting',
        //     'icon'  => '<i class="feather icon-settings"></i>',

        // ]);

        // /*------------ start Of introsliders ----------*/
        // Route::get('introsliders', [
        //     'uses'  => 'IntroSliderController@index',
        //     'as'    => 'introsliders.index',
        //     'title' => 'insolder',
        //     'icon'  => '<i class="feather icon-image"></i>',
        // ]);

        // # introsliders update
        // Route::get('introsliders/{id}/Show', [
        //     'uses'  => 'IntroSliderController@show',
        //     'as'    => 'introsliders.show',
        //     'title' => 'view_of_banner_page',
        // ]);

        // # socials store
        // Route::get('introsliders/create', [
        //     'uses'  => 'IntroSliderController@create',
        //     'as'    => 'introsliders.create',
        //     'title' => 'add_of_banner_page',
        // ]);

        // # introsliders store
        // Route::post('introsliders/store', [
        //     'uses'  => 'IntroSliderController@store',
        //     'as'    => 'introsliders.store',
        //     'title' => 'add_a_banner',
        // ]);

        // # socials update
        // Route::get('introsliders/{id}/edit', [
        //     'uses'  => 'IntroSliderController@edit',
        //     'as'    => 'introsliders.edit',
        //     'title' => 'edit_of_banner_page',
        // ]);

        // # introsliders update
        // Route::put('introsliders/{id}', [
        //     'uses'  => 'IntroSliderController@update',
        //     'as'    => 'introsliders.update',
        //     'title' => 'modification_of_banner',
        // ]);

        // # introsliders delete
        // Route::delete('introsliders/{id}', [
        //     'uses'  => 'IntroSliderController@destroy',
        //     'as'    => 'introsliders.delete',
        //     'title' => 'delete_a_banner',
        // ]);

        // #delete all introsliders
        // Route::post('delete-all-introsliders', [
        //     'uses'  => 'IntroSliderController@destroyAll',
        //     'as'    => 'introsliders.deleteAll',
        //     'title' => 'delete_multible_banner',
        // ]);
        // /*------------ end Of introsliders ----------*/

        // /*------------ start Of introservices ----------*/
        // Route::get('introservices', [
        //     'uses'  => 'IntroServiceController@index',
        //     'as'    => 'introservices.index',
        //     'title' => 'our_services',
        //     'icon'  => '<i class="la la-map"></i>',
        // ]);
        // # introservices update
        // Route::get('introservices/{id}/Show', [
        //     'uses'  => 'IntroServiceController@show',
        //     'as'    => 'introservices.show',
        //     'title' => 'view_services',
        // ]);
        // # socials store
        // Route::get('introservices/create', [
        //     'uses'  => 'IntroServiceController@create',
        //     'as'    => 'introservices.create',
        //     'title' => 'add_services',
        // ]);
        // # introservices store
        // Route::post('introservices/store', [
        //     'uses'  => 'IntroServiceController@store',
        //     'as'    => 'introservices.store',
        //     'title' => 'add_services',
        // ]);

        // # socials update
        // Route::get('introservices/{id}/edit', [
        //     'uses'  => 'IntroServiceController@edit',
        //     'as'    => 'introservices.edit',
        //     'title' => 'edit_services',
        // ]);

        // # introservices update
        // Route::put('introservices/{id}', [
        //     'uses'  => 'IntroServiceController@update',
        //     'as'    => 'introservices.update',
        //     'title' => 'edit_services',
        // ]);

        // # introservices delete
        // Route::delete('introservices/{id}', [
        //     'uses'  => 'IntroServiceController@destroy',
        //     'as'    => 'introservices.delete',
        //     'title' => 'delete_services',
        // ]);

        // #delete all introservices
        // Route::post('delete-all-introservices', [
        //     'uses'  => 'IntroServiceController@destroyAll',
        //     'as'    => 'introservices.deleteAll',
        //     'title' => 'delete_multible_services',
        // ]);
        // /*------------ end Of introservices ----------*/

        // /*------------ start Of introfqscategories ----------*/
        // Route::get('introfqscategories', [
        //     'uses'  => 'IntroFqsCategoryController@index',
        //     'as'    => 'introfqscategories.index',
        //     'title' => 'Common-questions_sections',
        //     'icon'  => '<i class="la la-list"></i>',
        // ]);
        // # socials store
        // Route::get('introfqscategories/create', [
        //     'uses'  => 'IntroFqsCategoryController@create',
        //     'as'    => 'introfqscategories.create',
        //     'title' => ' صفحة اضاjfgjfgjfفة قسم',
        // ]);
        // # introfqscategories store
        // Route::post('introfqscategories/store', [
        //     'uses'  => 'IntroFqsCategoryController@store',
        //     'as'    => 'introfqscategories.store',
        //     'title' => 'add_secjtrjtrjtrjtrjtrtion',
        // ]);
        // # introfqscategories update
        // Route::get('introfqscategories/{id}/edit', [
        //     'uses'  => 'IntroFqsCategoryController@edit',
        //     'as'    => 'introfqscategories.edit',
        //     'title' => 'edit_section_page',
        // ]);
        // # introfqscategories update
        // Route::put('introfqscategories/{id}', [
        //     'uses'  => 'IntroFqsCategoryController@update',
        //     'as'    => 'introfqscategories.update',
        //     'title' => 'edit_section',
        // ]);

        // # introfqscategories update
        // Route::get('introfqscategories/{id}/Show', [
        //     'uses'  => 'IntroFqsCategoryController@show',
        //     'as'    => 'introfqscategories.show',
        //     'title' => 'view_section_page',
        // ]);

        // # introfqscategories delete
        // Route::delete('introfqscategories/{id}', [
        //     'uses'  => 'IntroFqsCategoryController@destroy',
        //     'as'    => 'introfqscategories.delete',
        //     'title' => 'delete_section',
        // ]);

        // #delete all introfqscategories
        // Route::post('delete-all-introfqscategories', [
        //     'uses'  => 'IntroFqsCategoryController@destroyAll',
        //     'as'    => 'introfqscategories.deleteAll',
        //     'title' => 'delete_multible_section ',
        // ]);
        // /*------------ end Of introfqscategories ----------*/

        // /*------------ start Of introfqs ----------*/
        // Route::get('introfqs', [
        //     'uses'  => 'IntroFqsController@index',
        //     'as'    => 'introfqs.index',
        //     'title' => 'questions_sections',
        //     'icon'  => '<i class="la la-bullhorn"></i>',
        // ]);

        // # socials store
        // Route::get('introfqs/create', [
        //     'uses'  => 'IntroFqsController@create',
        //     'as'    => 'introfqs.create',
        //     'title' => 'add_question',
        // ]);

        // # introfqs store
        // Route::post('introfqs/store', [
        //     'uses'  => 'IntroFqsController@store',
        //     'as'    => 'introfqs.store',
        //     'title' => 'add_question',
        // ]);
        // # introfqscategories update
        // Route::get('introfqs/{id}/edit', [
        //     'uses'  => 'IntroFqsController@edit',
        //     'as'    => 'introfqs.edit',
        //     'title' => 'edit_question',
        // ]);
        // # introfqscategories update
        // Route::get('introfqs/{id}/Show', [
        //     'uses'  => 'IntroFqsController@show',
        //     'as'    => 'introfqs.show',
        //     'title' => 'view_question',
        // ]);

        // # introfqs update
        // Route::put('introfqs/{id}', [
        //     'uses'  => 'IntroFqsController@update',
        //     'as'    => 'introfqs.update',
        //     'title' => 'edit_question',
        // ]);

        // # introfqs delete
        // Route::delete('introfqs/{id}', [
        //     'uses'  => 'IntroFqsController@destroy',
        //     'as'    => 'introfqs.delete',
        //     'title' => 'delete_question',
        // ]);

        // #delete all introfqs
        // Route::post('delete-all-introfqs', [
        //     'uses'  => 'IntroFqsController@destroyAll',
        //     'as'    => 'introfqs.deleteAll',
        //     'title' => 'delete_multible_question',
        // ]);
        // /*------------ end Of introfqs ----------*/

        // /*------------ start Of introparteners ----------*/
        // Route::get('introparteners', [
        //     'uses'  => 'IntroPartenerController@index',
        //     'as'    => 'introparteners.index',
        //     'title' => 'Success_Partners',
        //     'icon'  => '<i class="la la-list"></i>',
        // ]);

        // # introparteners update
        // Route::get('introparteners/{id}/Show', [
        //     'uses'  => 'IntroPartenerController@show',
        //     'as'    => 'introparteners.show',
        //     'title' => 'view_partner_success',
        // ]);

        // # socials store
        // Route::get('introparteners/create', [
        //     'uses'  => 'IntroPartenerController@create',
        //     'as'    => 'introparteners.create',
        //     'title' => 'add_partner',
        // ]);

        // # introparteners store
        // Route::post('introparteners/store', [
        //     'uses'  => 'IntroPartenerController@store',
        //     'as'    => 'introparteners.store',
        //     'title' => 'add_partner',
        // ]);

        // # introparteners update
        // Route::get('introparteners/{id}/edit', [
        //     'uses'  => 'IntroPartenerController@edit',
        //     'as'    => 'introparteners.edit',
        //     'title' => 'edit_partner',
        // ]);

        // # introparteners update
        // Route::put('introparteners/{id}', [
        //     'uses'  => 'IntroPartenerController@update',
        //     'as'    => 'introparteners.update',
        //     'title' => 'edit_partner',
        // ]);

        // # introparteners delete
        // Route::delete('introparteners/{id}', [
        //     'uses'  => 'IntroPartenerController@destroy',
        //     'as'    => 'introparteners.delete',
        //     'title' => 'delete_partner',
        // ]);

        // #delete all introparteners
        // Route::post('delete-all-introparteners', [
        //     'uses'  => 'IntroPartenerController@destroyAll',
        //     'as'    => 'introparteners.deleteAll',
        //     'title' => 'delete_multible_partner',
        // ]);
        // /*------------ end Of introparteners ----------*/

        // /*------------ start Of intromessages ----------*/
        // Route::get('intromessages', [
        //     'uses'  => 'IntroMessagesController@index',
        //     'as'    => 'intromessages.index',
        //     'title' => 'Customer_messages',
        //     'icon'  => '<i class="la la-envelope-square"></i>',
        // ]);

        // # socials update
        // Route::get('intromessages/{id}', [
        //     'uses'  => 'IntroMessagesController@show',
        //     'as'    => 'intromessages.show',
        //     'title' => 'view_message',
        // ]);

        // # intromessages delete
        // Route::delete('intromessages/{id}', [
        //     'uses'  => 'IntroMessagesController@destroy',
        //     'as'    => 'intromessages.delete',
        //     'title' => 'delete_message',
        // ]);

        // #delete all intromessages
        // Route::post('delete-all-intromessages', [
        //     'uses'  => 'IntroMessagesController@destroyAll',
        //     'as'    => 'intromessages.deleteAll',
        //     'title' => 'delete_multible_message',
        // ]);
        // /*------------ end Of intromessages ----------*/

        // /*------------ start Of introsocials ----------*/
        // Route::get('introsocials', [
        //     'uses'  => 'IntroSocialController@index',
        //     'as'    => 'introsocials.index',
        //     'title' => 'socials',
        //     'icon'  => '<i class="la la-facebook"></i>',
        // ]);

        // # introsocials update
        // Route::get('introsocials/{id}/Show', [
        //     'uses'  => 'IntroSocialController@show',
        //     'as'    => 'introsocials.show',
        //     'title' => 'view_socials',
        // ]);
        // # introsocials store
        // Route::get('introsocials/create', [
        //     'uses'  => 'IntroSocialController@create',
        //     'as'    => 'introsocials.create',
        //     'title' => 'add_socials',
        // ]);

        // # introsocials store
        // Route::post('introsocials/store', [
        //     'uses'  => 'IntroSocialController@store',
        //     'as'    => 'introsocials.store',
        //     'title' => 'add_socials',
        // ]);
        // # introsocials update
        // Route::get('introsocials/{id}/edit', [
        //     'uses'  => 'IntroSocialController@edit',
        //     'as'    => 'introsocials.edit',
        //     'title' => 'edit_socials',
        // ]);

        // # introsocials update
        // Route::put('introsocials/{id}', [
        //     'uses'  => 'IntroSocialController@update',
        //     'as'    => 'introsocials.update',
        //     'title' => 'edit_socials',
        // ]);

        // # introsocials delete
        // Route::delete('introsocials/{id}', [
        //     'uses'  => 'IntroSocialController@destroy',
        //     'as'    => 'introsocials.delete',
        //     'title' => 'delete_socials',
        // ]);

        // #delete all introsocials
        // Route::post('delete-all-introsocials', [
        //     'uses'  => 'IntroSocialController@destroyAll',
        //     'as'    => 'introsocials.deleteAll',
        //     'title' => 'delete_multible_socials',
        // ]);
        // /*------------ end Of introsocials ----------*/

        // /*------------ start Of introhowworks ----------*/
        // Route::get('introhowworks', [
        //     'uses'  => 'IntroHowWorkController@index',
        //     'as'    => 'introhowworks.index',
        //     'title' => 'how_the_site_works',
        //     'icon'  => '<i class="la la-calendar-check-o"></i>',
        // ]);

        // # introhowworks store
        // Route::get('introhowworks/create', [
        //     'uses'  => 'IntroHowWorkController@create',
        //     'as'    => 'introhowworks.create',
        //     'title' => 'add_a_way_to_work',
        // ]);
        // # introfqscategories update
        // Route::get('introhowworks/{id}/Show', [
        //     'uses'  => 'IntroHowWorkController@show',
        //     'as'    => 'introhowworks.show',
        //     'title' => 'view_a_way_to_work',
        // ]);

        // # introhowworks update
        // Route::get('introhowworks/{id}/edit', [
        //     'uses'  => 'IntroHowWorkController@edit',
        //     'as'    => 'introhowworks.edit',
        //     'title' => 'edit_a_way_to_work',
        // ]);

        // # introhowworks store
        // Route::post('introhowworks/store', [
        //     'uses'  => 'IntroHowWorkController@store',
        //     'as'    => 'introhowworks.store',
        //     'title' => ' اضافة خطوه',
        // ]);

        // # introhowworks update
        // Route::put('introhowworks/{id}', [
        //     'uses'  => 'IntroHowWorkController@update',
        //     'as'    => 'introhowworks.update',
        //     'title' => 'تحديث خطوه',
        // ]);

        // # introhowworks delete
        // Route::delete('introhowworks/{id}', [
        //     'uses'  => 'IntroHowWorkController@destroy',
        //     'as'    => 'introhowworks.delete',
        //     'title' => 'حذف خطوه',
        // ]);

        // #delete all introhowworks
        // Route::post('delete-all-introhowworks', [
        //     'uses'  => 'IntroHowWorkController@destroyAll',
        //     'as'    => 'introhowworks.deleteAll',
        //     'title' => 'حذف مجموعه من كيف نعمل',
        // ]);
        /*------------ end Of introhowworks ----------*/

        /*------------ end Of intro site ----------*/

        /*------------ start Of users Controller ----------*/

        Route::get('all-users', [
            'as'        => 'intro_site',
            'icon'      => '<i class="feather icon-users"></i>',
            'title'     => 'users',
            'type'      => 'parent',
            'sub_route' => true,
            'child'     => [
                'clients.index','clients.show', 'clients.block', 'clients.store', 'clients.update', 'clients.delete', 'clients.notify', 'clients.deleteAll', 'clients.create', 'clients.edit','clients.importFile','clients.updateBalance',
                'providers.index','providers.create', 'providers.store','providers.edit', 'providers.update', 'providers.show', 'providers.delete'  ,'providers.deleteAll' ,
                'admins.index','admins.block', 'admins.store', 'admins.update', 'admins.edit','admins.delete', 'admins.deleteAll', 'admins.create', 'admins.edit', 'admins.notifications','admins.notifications.delete', 'admins.show',
            ],
        ]);

        Route::get('clients', [
            'uses'  => 'ClientController@index',
            'as'    => 'clients.index',
            'icon'  => '<i class="feather icon-users"></i>',
            'title' => 'clients',
            // 'type'  => 'parent',
            // 'child' => ['clients.show', 'clients.block', 'clients.store', 'clients.update', 'clients.delete', 'clients.notify', 'clients.deleteAll', 'clients.create', 'clients.edit','clients.importFile','clients.updateBalance'],
        ]);

        # clients store
        Route::get('clients/create', [
            'uses'  => 'ClientController@create',
            'as'    => 'clients.create', 'clients.edit',
            'title' => 'add_client',
        ]);
        
        # clients update
        Route::get('clients/{id}/edit', [
            'uses'  => 'ClientController@edit',
            'as'    => 'clients.edit',
            'title' => 'edit_client',
        ]);
        #store
        Route::post('clients/store', [
            'uses'  => 'ClientController@store',
            'as'    => 'clients.store',
            'title' => 'add_client',
        ]);
        #block
        Route::post('clients/block', [
            'uses'  => 'ClientController@block',
            'as'    => 'clients.block',
            'title' => 'block_client',
        ]);

        #update
        Route::put('clients/{id}', [
            'uses'  => 'ClientController@update',
            'as'    => 'clients.update',
            'title' => 'edit_client',
        ]);

        #add or deduct balance
        Route::post('clients/update-balance', [
            'uses'  => 'ClientController@updateBalance',
            'as'    => 'clients.updateBalance',
            'title' => 'update_balance',
        ]);
        Route::get('clients/{id}/show', [
            'uses'  => 'ClientController@show',
            'as'    => 'clients.show',
            'title' => 'view_user',
        ]);

        #delete
        Route::delete('clients/{id}', [
            'uses'  => 'ClientController@destroy',
            'as'    => 'clients.delete',
            'title' => 'delete_user',
        ]);

        #delete
        Route::post('delete-all-clients', [
            'uses'  => 'ClientController@destroyAll',
            'as'    => 'clients.deleteAll',
            'title' => 'delete_multible_user',
        ]);

        #notify
        Route::post('admins/clients/notify', [
            'uses'  => 'ClientController@notify',
            'as'    => 'clients.notify',
            'title' => 'Send_user_notification',
        ]);
        #import
        Route::post('clients/importFile', [
            'uses'  => 'ClientController@importFile',
            'as'    => 'clients.importFile',
            'title' => 'importfile',
        ]); 
        /************ #Clients ************/
        /*------------ end Of users Controller ----------*/

        /*------------ start Of providers ----------*/
        Route::get('show-providers/{id?}', [
            'uses'      => 'ProviderController@index',
            'as'        => 'providers.index',
            'title'     => 'providers',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['providers.create', 'providers.store','providers.edit', 'providers.update', 'providers.show', 'providers.delete'  ,'providers.deleteAll' ,]
        ]);

        # providers store
        Route::get('providers/create', [
            'uses'  => 'ProviderController@create',
            'as'    => 'providers.create',
            'title' => 'add_provider_page'
        ]);


        # providers store
        Route::post('providers/store', [
            'uses'  => 'ProviderController@store',
            'as'    => 'providers.store',
            'title' => 'add_provider'
        ]);

        # providers update
        Route::get('providers/{id}/edit', [
            'uses'  => 'ProviderController@edit',
            'as'    => 'providers.edit',
            'title' => 'update_provider_page'
        ]);

        # providers update
        Route::put('providers/{id}', [
            'uses'  => 'ProviderController@update',
            'as'    => 'providers.update',
            'title' => 'update_provider'
        ]);

        # providers show
        Route::get('providers/{id}/Show', [
            'uses'  => 'ProviderController@show',
            'as'    => 'providers.show',
            'title' => 'show_provider_page'
        ]);

        # providers delete
        Route::delete('providers/{id}', [
            'uses'  => 'ProviderController@destroy',
            'as'    => 'providers.delete',
            'title' => 'delete_provider'
        ]);
        #delete all providers
        Route::post('delete-all-providers', [
            'uses'  => 'ProviderController@destroyAll',
            'as'    => 'providers.deleteAll',
            'title' => 'delete_group_of_providers'
        ]);
        /*------------ end Of providers ----------*/

        /************ Admins ************/
        #index
        Route::get('admins', [
            'uses'  => 'AdminController@index',
            'as'    => 'admins.index',
            'title' => 'admins',
            'icon'  => '<i class="feather icon-users"></i>',
            // 'type'  => 'parent',
            // 'child' => [
            //     'admins.block', 'admins.index', 'admins.store', 'admins.update', 'admins.edit',
            //     'admins.delete', 'admins.deleteAll', 'admins.create', 'admins.edit', 'admins.notifications',
            //     'admins.notifications.delete', 'admins.show',
            // ],
        ]);

        # admins store
        Route::get('show-notifications', [
            'uses'  => 'AdminController@notifications',
            'as'    => 'admins.notifications',
            'title' => 'notification_page',
        ]);

        #block
        Route::post('admins/block', [
            'uses'  => 'AdminController@block',
            'as'    => 'admins.block',
            'title' => 'block_admin',
        ]);

        # admins store
        Route::post('delete-notifications', [
            'uses'  => 'AdminController@deleteNotifications',
            'as'    => 'admins.notifications.delete',
            'title' => 'delete_notification',
        ]);

        # admins store
        Route::get('admins/create', [
            'uses'  => 'AdminController@create',
            'as'    => 'admins.create',
            'title' => 'add_admin',
        ]);

        #store
        Route::post('admins/store', [
            'uses'  => 'AdminController@store',
            'as'    => 'admins.store',
            'title' => 'add_admin',
        ]);

        # admins update
        Route::get('admins/{id}/edit', [
            'uses'  => 'AdminController@edit',
            'as'    => 'admins.edit',
            'title' => 'edit_admin',
        ]);
        #update
        Route::put('admins/{id}', [
            'uses'  => 'AdminController@update',
            'as'    => 'admins.update',
            'title' => 'edit_admin',
        ]);

        Route::get('admins/{id}/show', [
            'uses'  => 'AdminController@show',
            'as'    => 'admins.show',
            'title' => 'view_admin',
        ]);

        #delete
        Route::delete('admins/{id}', [
            'uses'  => 'AdminController@destroy',
            'as'    => 'admins.delete',
            'title' => 'delete_admin',
        ]);

        #delete
        Route::post('delete-all-admins', [
            'uses'  => 'AdminController@destroyAll',
            'as'    => 'admins.deleteAll',
            'title' => 'delete_multible_admin',
        ]);

        /************ #Admins ************/

        Route::get('hjzee', [
            'as'        => 'hjzee',
            'icon'      => '<i class="feather icon-list"></i>',
            'title'     => 'hjzee',
            'type'      => 'parent',
            'sub_route' => true,
            'child'     => [
                'services-categories.index','services-categories.export', 'services-categories.create', 'services-categories.store', 'services-categories.edit', 'services-categories.update', 'services-categories.delete', 'services-categories.deleteAll', 'services-categories.show',
                'places-categories.index','places-categories.export', 'places-categories.create', 'places-categories.store', 'places-categories.edit', 'places-categories.update', 'places-categories.delete', 'places-categories.deleteAll', 'places-categories.show',
                'services.index','services.create', 'services.store','services.edit', 'services.update', 'services.show', 'services.delete'  ,'services.deleteAll' ,'services.delete.image',
                'places.index','places.create', 'places.store','places.edit', 'places.update', 'places.show', 'places.delete'  ,'places.deleteAll' ,'places.delete.image',
                'meetingrooms.index','meetingrooms.create', 'meetingrooms.store','meetingrooms.edit', 'meetingrooms.update', 'meetingrooms.show', 'meetingrooms.delete'  ,'meetingrooms.deleteAll','meetingrooms.delete.image',
                'orders.index','orders.create', 'orders.store','orders.edit', 'orders.update', 'orders.show', 'orders.delete'  ,'orders.deleteAll','orders.get-room-available-times','orders.get-provider-places','orders.get-provider-services','orders.get-place-meeting-rooms' ,
                'options.index','options.create', 'options.store','options.edit', 'options.update', 'options.show', 'options.delete'  ,'options.deleteAll' ,
                'service-ratings.index','service-ratings.create', 'service-ratings.store','service-ratings.edit', 'service-ratings.update', 'service-ratings.show', 'service-ratings.delete'  ,'service-ratings.deleteAll' ,
                'place-ratings.index','place-ratings.create', 'place-ratings.store','place-ratings.edit', 'place-ratings.update', 'place-ratings.show', 'place-ratings.delete'  ,'place-ratings.deleteAll' ,
                'provider-ratings.index','provider-ratings.create', 'provider-ratings.store','provider-ratings.edit', 'provider-ratings.update', 'provider-ratings.show', 'provider-ratings.delete'  ,'provider-ratings.deleteAll' ,
                'adminreports.index','adminreports.create', 'adminreports.store', 'adminreports.edit', 'adminreports.update', 'adminreports.show', 'adminreports.delete', 'adminreports.deleteAll',
                // 'settlements.index','settlements.show','settlements.changeStatus',
            ],
        ]);
            /*------------ start Of options ----------*/
            Route::get('options', [
                'uses'      => 'OptionsController@index',
                'as'        => 'options.index',
                'title'     => 'options',
                'icon'      => '<i class="feather icon-image"></i>',
                // 'type'      => 'parent',
                // 'sub_route' => false,
                // 'child'     => ['options.create', 'options.store','options.edit', 'options.update', 'options.show', 'options.delete'  ,'options.deleteAll' ,]
            ]);
    
            # options store
            Route::get('options/create', [
                'uses'  => 'OptionsController@create',
                'as'    => 'options.create',
                'title' => 'add_options_page'
            ]);
    
    
            # options store
            Route::post('options/store', [
                'uses'  => 'OptionsController@store',
                'as'    => 'options.store',
                'title' => 'add_options'
            ]);
    
            # options update
            Route::get('options/{id}/edit', [
                'uses'  => 'OptionsController@edit',
                'as'    => 'options.edit',
                'title' => 'update_options_page'
            ]);
    
            # options update
            Route::put('options/{id}', [
                'uses'  => 'OptionsController@update',
                'as'    => 'options.update',
                'title' => 'update_options'
            ]);
    
            # options show
            Route::get('options/{id}/Show', [
                'uses'  => 'OptionsController@show',
                'as'    => 'options.show',
                'title' => 'show_options_page'
            ]);
    
            # options delete
            Route::delete('options/{id}', [
                'uses'  => 'OptionsController@destroy',
                'as'    => 'options.delete',
                'title' => 'delete_options'
            ]);
            #delete all options
            Route::post('delete-all-options', [
                'uses'  => 'OptionsController@destroyAll',
                'as'    => 'options.deleteAll',
                'title' => 'delete_group_of_options'
            ]);
        /*------------ end Of options ----------*/
    /*------------ start Of orders ----------*/
        Route::get('orders', [
            'uses'      => 'OrdersController@index',
            'as'        => 'orders.index',
            'title'     => 'reservations',
            'icon'      => '<i class="feather icon-list"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['orders.create', 'orders.store','orders.edit', 'orders.update', 'orders.show', 'orders.delete'  ,'orders.deleteAll' ,'orders.get-team-players','orders.get-user-friends','orders.get-city-playgrounds','orders.get-playground-available-times']
        ]);

        Route::get('get-room-available-times', [
            'uses'  => 'OrdersController@getRoomAvailableTimes',
            'as'    => 'orders.get-room-available-times',
            'title' => 'get_room_available_times'
        ]); 
        Route::get('get-provider-places', [
            'uses'  => 'OrdersController@getProviderPlaces',
            'as'    => 'orders.get-provider-places',
            'title' => 'get_provider_places'
        ]); 

        Route::get('get-provider-services', [
            'uses'  => 'OrdersController@getProviderServices',
            'as'    => 'orders.get-provider-services',
            'title' => 'get_provider_services'
        ]); 

        Route::get('get-place-meeting-rooms', [
            'uses'  => 'OrdersController@getPlaceMeetingRooms',
            'as'    => 'orders.get-place-meeting-rooms',
            'title' => 'get_place_meeting_rooms'
        ]); 

        # orders store
        Route::get('orders/create', [
            'uses'  => 'OrdersController@create',
            'as'    => 'orders.create',
            'title' => 'add_reservation_page'
        ]);


        # orders store
        Route::post('orders/store', [
            'uses'  => 'OrdersController@store',
            'as'    => 'orders.store',
            'title' => 'add_reservation'
        ]);

        # orders update
        Route::get('orders/{id}/edit', [
            'uses'  => 'OrdersController@edit',
            'as'    => 'orders.edit',
            'title' => 'update_reservation_page'
        ]);

        # orders update
        Route::put('orders/{id}', [
            'uses'  => 'OrdersController@update',
            'as'    => 'orders.update',
            'title' => 'update_reservation'
        ]);

        # orders show
        Route::get('orders/{id}/Show', [
            'uses'  => 'OrdersController@show',
            'as'    => 'orders.show',
            'title' => 'show_reservation_page'
        ]);

        # orders delete
        Route::delete('orders/{id}', [
            'uses'  => 'OrdersController@destroy',
            'as'    => 'orders.delete',
            'title' => 'delete_reservation'
        ]);
        #delete all orders
        Route::post('delete-all-orders', [
            'uses'  => 'OrdersController@destroyAll',
            'as'    => 'orders.deleteAll',
            'title' => 'delete_group_of_reservations'
        ]);

    /*------------ start Of orders ----------*/
    /*------------ start Of services ----------*/
    Route::get('services', [
        'uses'      => 'ServiceController@index',
        'as'        => 'services.index',
        'title'     => 'services',
        'icon'      => '<i class="feather icon-image"></i>',
        // 'type'      => 'parent',
        // 'sub_route' => false,
        // 'child'     => ['services.create', 'services.store','services.edit', 'services.update', 'services.show', 'services.delete'  ,'services.deleteAll' ,'services.delete.image']
    ]);

    # services store
    Route::get('services/create', [
        'uses'  => 'ServiceController@create',
        'as'    => 'services.create',
        'title' => 'add_service_page'
    ]);


    # services store
    Route::post('services/store', [
        'uses'  => 'ServiceController@store',
        'as'    => 'services.store',
        'title' => 'add_service'
    ]);

    # services update
    Route::get('services/{id}/edit', [
        'uses'  => 'ServiceController@edit',
        'as'    => 'services.edit',
        'title' => 'update_service_page'
    ]);

    # services update
    Route::put('services/{id}', [
        'uses'  => 'ServiceController@update',
        'as'    => 'services.update',
        'title' => 'update_service'
    ]);

    # services show
    Route::get('services/{id}/Show', [
        'uses'  => 'ServiceController@show',
        'as'    => 'services.show',
        'title' => 'show_service_page'
    ]);

    # services delete
    Route::delete('services/{id}', [
        'uses'  => 'ServiceController@destroy',
        'as'    => 'services.delete',
        'title' => 'delete_service'
    ]);
    #delete all services
    Route::post('delete-all-services', [
        'uses'  => 'ServiceController@destroyAll',
        'as'    => 'services.deleteAll',
        'title' => 'delete_group_of_services'
    ]);
    Route::post('services/delete-image', [
        'uses'  => 'ServiceController@deleteImage',
        'as'    => 'services.delete.image',
        'title' => 'delete_image'
    ]);
/*------------ end Of services ----------*/

/*------------ start Of places ----------*/
    Route::get('places', [
        'uses'      => 'PlaceController@index',
        'as'        => 'places.index',
        'title'     => 'places',
        'icon'      => '<i class="feather icon-image"></i>',
        // 'type'      => 'parent',
        // 'sub_route' => false,
        // 'child'     => ['places.create', 'places.store','places.edit', 'places.update', 'places.show', 'places.delete'  ,'places.deleteAll' ,]
    ]);

    # places store
    Route::get('places/create', [
        'uses'  => 'PlaceController@create',
        'as'    => 'places.create',
        'title' => 'add_place_page'
    ]);


    # places store
    Route::post('places/store', [
        'uses'  => 'PlaceController@store',
        'as'    => 'places.store',
        'title' => 'add_place'
    ]);

    # places update
    Route::get('places/{id}/edit', [
        'uses'  => 'PlaceController@edit',
        'as'    => 'places.edit',
        'title' => 'update_place_page'
    ]);

    # places update
    Route::put('places/{id}', [
        'uses'  => 'PlaceController@update',
        'as'    => 'places.update',
        'title' => 'update_place'
    ]);

    # places show
    Route::get('places/{id}/Show', [
        'uses'  => 'PlaceController@show',
        'as'    => 'places.show',
        'title' => 'show_place_page'
    ]);

    # places delete
    Route::delete('places/{id}', [
        'uses'  => 'PlaceController@destroy',
        'as'    => 'places.delete',
        'title' => 'delete_place'
    ]);
    #delete all places
    Route::post('delete-all-places', [
        'uses'  => 'PlaceController@destroyAll',
        'as'    => 'places.deleteAll',
        'title' => 'delete_group_of_places'
    ]);
    Route::post('places/delete-image', [
        'uses'  => 'PlaceController@deleteImage',
        'as'    => 'places.delete.image',
        'title' => 'delete_image'
    ]);
/*------------ end Of places ----------*/
    /*------------ start Of meetingrooms ----------*/
    Route::get('meetingrooms', [
        'uses'      => 'MeetingRoomController@index',
        'as'        => 'meetingrooms.index',
        'title'     => 'meetingrooms',
        'icon'      => '<i class="feather icon-image"></i>',
        // 'type'      => 'parent',
        // 'sub_route' => false,
        // 'child'     => ['meetingrooms.create', 'meetingrooms.store','meetingrooms.edit', 'meetingrooms.update', 'meetingrooms.show', 'meetingrooms.delete'  ,'meetingrooms.deleteAll' ,]
    ]);

    # meetingrooms store
    Route::get('meetingrooms/create', [
        'uses'  => 'MeetingRoomController@create',
        'as'    => 'meetingrooms.create',
        'title' => 'add_meetingroom_page'
    ]);


    # meetingrooms store
    Route::post('meetingrooms/store', [
        'uses'  => 'MeetingRoomController@store',
        'as'    => 'meetingrooms.store',
        'title' => 'add_meetingroom'
    ]);

    # meetingrooms update
    Route::get('meetingrooms/{id}/edit', [
        'uses'  => 'MeetingRoomController@edit',
        'as'    => 'meetingrooms.edit',
        'title' => 'update_meetingroom_page'
    ]);

    # meetingrooms update
    Route::put('meetingrooms/{id}', [
        'uses'  => 'MeetingRoomController@update',
        'as'    => 'meetingrooms.update',
        'title' => 'update_meetingroom'
    ]);

    # meetingrooms show
    Route::get('meetingrooms/{id}/Show', [
        'uses'  => 'MeetingRoomController@show',
        'as'    => 'meetingrooms.show',
        'title' => 'show_meetingroom_page'
    ]);

    # meetingrooms delete
    Route::delete('meetingrooms/{id}', [
        'uses'  => 'MeetingRoomController@destroy',
        'as'    => 'meetingrooms.delete',
        'title' => 'delete_meetingroom'
    ]);
    #delete all meetingrooms
    Route::post('delete-all-meetingrooms', [
        'uses'  => 'MeetingRoomController@destroyAll',
        'as'    => 'meetingrooms.deleteAll',
        'title' => 'delete_group_of_meetingrooms'
    ]);
    Route::post('meetingrooms/delete-image', [
        'uses'  => 'MeetingRoomController@deleteImage',
        'as'    => 'meetingrooms.delete.image',
        'title' => 'delete_image'
    ]);
/*------------ end Of meetingrooms ----------*/
/*------------ start Of service-ratings ----------*/
    Route::get('service-ratings', [
        'uses'      => 'RatingServiceController@index',
        'as'        => 'service-ratings.index',
        'title'     => 'service-ratings',
        'icon'      => '<i class="feather icon-image"></i>',
        // 'type'      => 'parent',
        // 'sub_route' => false,
        // 'child'     => ['service-ratings.create', 'service-ratings.store','service-ratings.edit', 'service-ratings.update', 'service-ratings.show', 'service-ratings.delete'  ,'service-ratings.deleteAll' ,]
    ]);

    # ratings store
    Route::get('service-ratings/create', [
        'uses'  => 'RatingServiceController@create',
        'as'    => 'service-ratings.create',
        'title' => 'add_rating_page'
    ]);


    # ratings store
    Route::post('service-ratings/store', [
        'uses'  => 'RatingServiceController@store',
        'as'    => 'service-ratings.store',
        'title' => 'add_rating'
    ]);

    # ratings update
    Route::get('service-ratings/{id}/edit', [
        'uses'  => 'RatingServiceController@edit',
        'as'    => 'service-ratings.edit',
        'title' => 'update_rating_page'
    ]);

    # ratings update
    Route::put('service-ratings/{id}', [
        'uses'  => 'RatingServiceController@update',
        'as'    => 'service-ratings.update',
        'title' => 'update_rating'
    ]);

    # ratings show
    Route::get('service-ratings/{id}/Show', [
        'uses'  => 'RatingServiceController@show',
        'as'    => 'service-ratings.show',
        'title' => 'show_rating_page'
    ]);

    # ratings delete
    Route::delete('service-ratings/{id}', [
        'uses'  => 'RatingServiceController@destroy',
        'as'    => 'service-ratings.delete',
        'title' => 'delete_rating'
    ]);
    #delete all ratings
    Route::post('delete-all-service-ratings', [
        'uses'  => 'RatingServiceController@destroyAll',
        'as'    => 'service-ratings.deleteAll',
        'title' => 'delete_group_of_ratings'
    ]);
/*------------ end Of service-ratings ----------*/
/*------------ start Of place-ratings ----------*/
    Route::get('place-ratings', [
        'uses'      => 'RatingPlaceController@index',
        'as'        => 'place-ratings.index',
        'title'     => 'place-ratings',
        'icon'      => '<i class="feather icon-image"></i>',
        // 'type'      => 'parent',
        // 'sub_route' => false,
        // 'child'     => ['place-ratings.create', 'place-ratings.store','place-ratings.edit', 'place-ratings.update', 'place-ratings.show', 'place-ratings.delete'  ,'place-ratings.deleteAll' ,]
    ]);

    # ratings store
    Route::get('place-ratings/create', [
        'uses'  => 'RatingPlaceController@create',
        'as'    => 'place-ratings.create',
        'title' => 'add_rating_page'
    ]);


    # ratings store
    Route::post('place-ratings/store', [
        'uses'  => 'RatingPlaceController@store',
        'as'    => 'place-ratings.store',
        'title' => 'add_rating'
    ]);

    # ratings update
    Route::get('place-ratings/{id}/edit', [
        'uses'  => 'RatingPlaceController@edit',
        'as'    => 'place-ratings.edit',
        'title' => 'update_rating_page'
    ]);

    # ratings update
    Route::put('place-ratings/{id}', [
        'uses'  => 'RatingPlaceController@update',
        'as'    => 'place-ratings.update',
        'title' => 'update_rating'
    ]);

    # ratings show
    Route::get('place-ratings/{id}/Show', [
        'uses'  => 'RatingPlaceController@show',
        'as'    => 'place-ratings.show',
        'title' => 'show_rating_page'
    ]);

    # ratings delete
    Route::delete('place-ratings/{id}', [
        'uses'  => 'RatingPlaceController@destroy',
        'as'    => 'place-ratings.delete',
        'title' => 'delete_rating'
    ]);
    #delete all ratings
    Route::post('delete-all-place-ratings', [
        'uses'  => 'RatingPlaceController@destroyAll',
        'as'    => 'place-ratings.deleteAll',
        'title' => 'delete_group_of_ratings'
    ]);
    /*------------ end Of place-ratings ----------*/
    /*------------ start Of provider-ratings ----------*/
    Route::get('provider-ratings', [
        'uses'      => 'RatingProviderController@index',
        'as'        => 'provider-ratings.index',
        'title'     => 'provider-ratings',
        'icon'      => '<i class="feather icon-image"></i>',
        // 'type'      => 'parent',
        // 'sub_route' => false,
        // 'child'     => ['provider-ratings.create', 'provider-ratings.store','provider-ratings.edit', 'provider-ratings.update', 'provider-ratings.show', 'provider-ratings.delete'  ,'provider-ratings.deleteAll' ,]
    ]);

    # ratings store
    Route::get('provider-ratings/create', [
        'uses'  => 'RatingProviderController@create',
        'as'    => 'provider-ratings.create',
        'title' => 'add_rating_page'
    ]);


    # ratings store
    Route::post('provider-ratings/store', [
        'uses'  => 'RatingProviderController@store',
        'as'    => 'provider-ratings.store',
        'title' => 'add_rating'
    ]);

    # ratings update
    Route::get('provider-ratings/{id}/edit', [
        'uses'  => 'RatingProviderController@edit',
        'as'    => 'provider-ratings.edit',
        'title' => 'update_rating_page'
    ]);

    # ratings update
    Route::put('provider-ratings/{id}', [
        'uses'  => 'RatingProviderController@update',
        'as'    => 'provider-ratings.update',
        'title' => 'update_rating'
    ]);

    # ratings show
    Route::get('provider-ratings/{id}/Show', [
        'uses'  => 'RatingProviderController@show',
        'as'    => 'provider-ratings.show',
        'title' => 'show_rating_page'
    ]);

    # ratings delete
    Route::delete('provider-ratings/{id}', [
        'uses'  => 'RatingProviderController@destroy',
        'as'    => 'provider-ratings.delete',
        'title' => 'delete_rating'
    ]);
    #delete all ratings
    Route::post('delete-all-provider-ratings', [
        'uses'  => 'RatingProviderController@destroyAll',
        'as'    => 'provider-ratings.deleteAll',
        'title' => 'delete_group_of_ratings'
    ]);
    /*------------ end Of provider-ratings ----------*/
       
        /*------------ start Of adminreports ----------*/
        Route::get('adminreports', [
            'uses'      => 'adminReportsController@AdminFinancial',
            'as'        => 'adminreports.index',
            'title'     => 'admin_financial_reports',
            'icon'      => '<i class="feather icon-dollar-sign"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['adminreports.create', 'adminreports.store', 'adminreports.edit', 'adminreports.update', 'adminreports.show', 'adminreports.delete', 'adminreports.deleteAll'],
        ]);

        # adminreports store
        Route::get('adminreports/create', [
            'uses'  => 'adminReportsController@create',
            'as'    => 'adminreports.create',
            'title' => ' صفحة اضافة تقرير',
        ]);

        # adminreports store
        Route::post('adminreports/store', [
            'uses'  => 'adminReportsController@store',
            'as'    => 'adminreports.store',
            'title' => ' اضافة تقرير',
        ]);

        # adminreports update
        Route::get('adminreports/{id}/edit', [
            'uses'  => 'adminReportsController@edit',
            'as'    => 'adminreports.edit',
            'title' => 'صفحه تحديث تقرير',
        ]);

        # adminreports update
        Route::put('adminreports/{id}', [
            'uses'  => 'adminReportsController@update',
            'as'    => 'adminreports.update',
            'title' => 'تحديث تقرير',
        ]);

        # adminreports show
        Route::get('adminreports/{id}/Show', [
            'uses'  => 'adminReportsController@show',
            'as'    => 'adminreports.show',
            'title' => 'صفحه عرض  تقرير  ',
        ]);

        # adminreports delete
        Route::delete('adminreports/{id}', [
            'uses'  => 'adminReportsController@destroy',
            'as'    => 'adminreports.delete',
            'title' => 'حذف تقرير',
        ]);
        #delete all adminreports
        Route::post('delete-all-adminreports', [
            'uses'  => 'adminReportsController@destroyAll',
            'as'    => 'adminreports.deleteAll',
            'title' => 'حذف مجموعه من التقارير',
        ]);
        /*------------ end Of adminreports ----------*/
    /*------------ start Of categories ----------*/
        Route::get('services-categories-show/{id?}', [
            'uses'      => 'CategorySericeController@index',
            'as'        => 'services-categories.index',
            'title'     => 'services-sections',
            'icon'      => '<i class="feather icon-list"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['categories.export', 'categories.create', 'categories.store', 'categories.edit', 'categories.update', 'categories.delete', 'categories.deleteAll', 'categories.show'],
        ]);

        # categories store
        Route::get('services-categories/export', [
            'uses'  => 'CategorySericeController@export',
            'as'    => 'services-categories.export',
            'title' => 'export',
        ]);
        # categories store
        Route::get('services-categories/create/{id?}', [
            'uses'  => 'CategorySericeController@create',
            'as'    => 'services-categories.create',
            'title' => 'add_section',
        ]);

        # categories store
        Route::post('services-categories/store', [
            'uses'  => 'CategorySericeController@store',
            'as'    => 'services-categories.store',
            'title' => 'add_section',
        ]);

        # categories update
        Route::get('services-categories/{id}/edit', [
            'uses'  => 'CategorySericeController@edit',
            'as'    => 'services-categories.edit',
            'title' => 'edit_section_page',
        ]);

        # categories update
        Route::put('services-categories/{id}', [
            'uses'  => 'CategorySericeController@update',
            'as'    => 'services-categories.update',
            'title' => 'edit_section',
        ]);

        Route::get('services-categories/{id}/show', [
            'uses'  => 'CategorySericeController@show',
            'as'    => 'services-categories.show',
            'title' => 'view_section',
        ]);

        # categories delete
        Route::delete('services-categories/{id}', [
            'uses'  => 'CategorySericeController@destroy',
            'as'    => 'services-categories.delete',
            'title' => 'delete_section',
        ]);
        #delete all categories
        Route::post('services-delete-all-categories', [
            'uses'  => 'CategorySericeController@destroyAll',
            'as'    => 'services-categories.deleteAll',
            'title' => 'delete_multible_section',
        ]);
        Route::get('places-categories-show/{id?}', [
            'uses'      => 'CategoryPlaceController@index',
            'as'        => 'places-categories.index',
            'title'     => 'places-sections',
            'icon'      => '<i class="feather icon-list"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['categories.export', 'categories.create', 'categories.store', 'categories.edit', 'categories.update', 'categories.delete', 'categories.deleteAll', 'categories.show'],
        ]);

        # categories store
        Route::get('places-categories/export', [
            'uses'  => 'CategoryPlaceController@export',
            'as'    => 'places-categories.export',
            'title' => 'export',
        ]);
        # categories store
        Route::get('places-categories/create/{id?}', [
            'uses'  => 'CategoryPlaceController@create',
            'as'    => 'places-categories.create',
            'title' => 'add_section',
        ]);

        # categories store
        Route::post('places-categories/store', [
            'uses'  => 'CategoryPlaceController@store',
            'as'    => 'places-categories.store',
            'title' => 'add_section',
        ]);

        # categories update
        Route::get('places-categories/{id}/edit', [
            'uses'  => 'CategoryPlaceController@edit',
            'as'    => 'places-categories.edit',
            'title' => 'edit_section_page',
        ]);

        # categories update
        Route::put('places-categories/{id}', [
            'uses'  => 'CategoryPlaceController@update',
            'as'    => 'places-categories.update',
            'title' => 'edit_section',
        ]);

        Route::get('places-categories/{id}/show', [
            'uses'  => 'CategoryPlaceController@show',
            'as'    => 'places-categories.show',
            'title' => 'view_section',
        ]);

        # categories delete
        Route::delete('places-categories/{id}', [
            'uses'  => 'CategoryPlaceController@destroy',
            'as'    => 'places-categories.delete',
            'title' => 'delete_section',
        ]);
        #delete all categories
        Route::post('places-delete-all-categories', [
            'uses'  => 'CategoryPlaceController@destroyAll',
            'as'    => 'places-categories.deleteAll',
            'title' => 'delete_multible_section',
        ]);
        /*------------ end Of categories ----------*/
        /*------------ start Of Settlements----------*/
        Route::get('settlements', [
            'uses'      => 'SettlementController@index',
            'as'        => 'settlements.index',
            'title'     => 'Settlement_requests',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => [
            //     'settlements.show',
            //     'settlements.changeStatus',
            // ],
        ]);

        #Show Settlement
        Route::get('settlements/show/{id}', [
            'uses'  => 'SettlementController@show',
            'as'    => 'settlements.show',
            'title' => 'view_Settlement_order',
        ]);

        #Change Settlement Status
        Route::post('settlements/change-status', [
            'uses'  => 'SettlementController@settlementChangeStatus',
            'as'    => 'settlements.changeStatus',
            'title' => 'تغير حالة طلبات التسوية',
        ]);
        /*------------ end Of Settlements ----------*/
                /*------------ start Of notifications ----------*/
                Route::get('marketing', [
                    'as'        => 'marketing',
                    'icon'      => '<i class="feather icon-flag"></i>',
                    'title'     => 'marketing',
                    'type'      => 'parent',
                    'sub_route' => true,
                    'child'     => [
                        'notifications.index','notifications.send',
                        'coupons.index','coupons.show', 'coupons.create', 'coupons.store', 'coupons.edit', 'coupons.update', 'coupons.delete', 'coupons.deleteAll', 'coupons.renew',
                        'images.index','images.show', 'images.create', 'images.store', 'images.edit', 'images.update', 'images.delete', 'images.deleteAll',
                        'socials.index','socials.show', 'socials.create', 'socials.store', 'socials.show', 'socials.update', 'socials.edit', 'socials.delete', 'socials.deleteAll',
                        'intros.index','intros.show', 'intros.create', 'intros.store', 'intros.edit', 'intros.update', 'intros.delete', 'intros.deleteAll',
                        // 'seos.index','seos.show', 'seos.create', 'seos.edit', 'seos.index', 'seos.store', 'seos.update', 'seos.delete', 'seos.deleteAll',
                        // 'statistics.index',
                    ],
                ]);
        
                Route::get('notifications', [
                    'uses'      => 'NotificationController@index',
                    'as'        => 'notifications.index',
                    'title'     => 'notifications',
                    'icon'      => '<i class="ficon feather icon-bell"></i>',
                    // 'type'      => 'parent',
                    // 'sub_route' => false,
                    // 'child'     => ['notifications.send'],
                ]);
        
                # coupons store
                Route::post('send-notifications', [
                    'uses'  => 'NotificationController@sendNotifications',
                    'as'    => 'notifications.send',
                    'title' => 'send_notification_email_to_client',
                ]);
                /*------------ end Of notifications ----------*/
               /*------------ start Of coupons ----------*/
                Route::get('coupons', [
                    'uses'      => 'CouponController@index',
                    'as'        => 'coupons.index',
                    'title'     => 'coupons',
                    'icon'      => '<i class="fa fa-gift"></i>',
                    // 'type'      => 'parent',
                    // 'sub_route' => false,
                    // 'child'     => ['coupons.show', 'coupons.create', 'coupons.store', 'coupons.edit', 'coupons.update', 'coupons.delete', 'coupons.deleteAll', 'coupons.renew'],
                ]);
        
                Route::get('coupons/{id}/show', [
                    'uses'  => 'CouponController@show',
                    'as'    => 'coupons.show',
                    'title' => 'view_coupons',
                ]);
        
                # coupons store
                Route::get('coupons/create', [
                    'uses'  => 'CouponController@create',
                    'as'    => 'coupons.create',
                    'title' => 'add_coupons',
                ]);
        
                # coupons store
                Route::post('coupons/store', [
                    'uses'  => 'CouponController@store',
                    'as'    => 'coupons.store',
                    'title' => 'add_coupons',
                ]);
        
                # coupons update
                Route::get('coupons/{id}/edit', [
                    'uses'  => 'CouponController@edit',
                    'as'    => 'coupons.edit',
                    'title' => 'edit_coupons',
                ]);
        
                # coupons update
                Route::put('coupons/{id}', [
                    'uses'  => 'CouponController@update',
                    'as'    => 'coupons.update',
                    'title' => 'edit_coupons',
                ]);
        
                # renew coupon
                Route::post('coupons/renew', [
                    'uses'  => 'CouponController@renew',
                    'as'    => 'coupons.renew',
                    'title' => 'update_coupon_status',
                ]);
        
                # coupons delete
                Route::delete('coupons/{id}', [
                    'uses'  => 'CouponController@destroy',
                    'as'    => 'coupons.delete',
                    'title' => 'delete_coupons',
                ]);
                #delete all coupons
                Route::post('delete-all-coupons', [
                    'uses'  => 'CouponController@destroyAll',
                    'as'    => 'coupons.deleteAll',
                    'title' => 'delete_multible_coupons',
                ]);
                /*------------ end Of coupons ----------*/

                /*------------ start Of images ----------*/
                Route::get('images', [
                    'uses'      => 'ImageController@index',
                    'as'        => 'images.index',
                    'title'     => 'advertising_banners',
                    'icon'      => '<i class="feather icon-image"></i>',
                    // 'type'      => 'parent',
                    // 'sub_route' => false,
                    // 'child'     => ['images.show', 'images.create', 'images.store', 'images.edit', 'images.update', 'images.delete', 'images.deleteAll'],
                ]);
                Route::get('images/{id}/show', [
                    'uses'  => 'ImageController@show',
                    'as'    => 'images.show',
                    'title' => 'view_of_banner',
                ]);
                # images store
                Route::get('images/create', [
                    'uses'  => 'ImageController@create',
                    'as'    => 'images.create',
                    'title' => 'add_a_banner',
                ]);
        
                # images store
                Route::post('images/store', [
                    'uses'  => 'ImageController@store',
                    'as'    => 'images.store',
                    'title' => 'add_a_banner',
                ]);
        
                # images update
                Route::get('images/{id}/edit', [
                    'uses'  => 'ImageController@edit',
                    'as'    => 'images.edit',
                    'title' => 'modification_of_banner',
                ]);
        
                # images update
                Route::put('images/{id}', [
                    'uses'  => 'ImageController@update',
                    'as'    => 'images.update',
                    'title' => 'modification_of_banner',
                ]);
        
                # images delete
                Route::delete('images/{id}', [
                    'uses'  => 'ImageController@destroy',
                    'as'    => 'images.delete',
                    'title' => 'delete_a_banner',
                ]);
                #delete all images
                Route::post('delete-all-images', [
                    'uses'  => 'ImageController@destroyAll',
                    'as'    => 'images.deleteAll',
                    'title' => 'delete_multible_banner',
                ]);
                /*------------ end Of images ----------*/
        
                /*------------ start Of socials ----------*/
                Route::get('socials', [
                    'uses'      => 'SocialController@index',
                    'as'        => 'socials.index',
                    'title'     => 'socials',
                    'icon'      => '<i class="feather icon-message-circle"></i>',
                    // 'type'      => 'parent',
                    // 'sub_route' => false,
                    // 'child'     => ['socials.show', 'socials.create', 'socials.store', 'socials.show', 'socials.update', 'socials.edit', 'socials.delete', 'socials.deleteAll'],
                ]);
                # socials update
                Route::get('socials/{id}/Show', [
                    'uses'  => 'SocialController@show',
                    'as'    => 'socials.show',
                    'title' => 'view_socials',
                ]);
                # socials store
                Route::get('socials/create', [
                    'uses'  => 'SocialController@create',
                    'as'    => 'socials.create',
                    'title' => 'add_socials',
                ]);
        
                # socials store
                Route::post('socials', [
                    'uses'  => 'SocialController@store',
                    'as'    => 'socials.store',
                    'title' => 'add_socials',
                ]);
                # socials update
                Route::get('socials/{id}/edit', [
                    'uses'  => 'SocialController@edit',
                    'as'    => 'socials.edit',
                    'title' => 'edit_socials',
                ]);
                # socials update
                Route::put('socials/{id}', [
                    'uses'  => 'SocialController@update',
                    'as'    => 'socials.update',
                    'title' => 'edit_socials',
                ]);
        
                # socials delete
                Route::delete('socials/{id}', [
                    'uses'  => 'SocialController@destroy',
                    'as'    => 'socials.delete',
                    'title' => 'delete_socials',
                ]);
        
                #delete all socials
                Route::post('delete-all-socials', [
                    'uses'  => 'SocialController@destroyAll',
                    'as'    => 'socials.deleteAll',
                    'title' => 'delete_multible_socials',
                ]);
                /*------------ end Of socials ----------*/
        /*------------ start Of intros ----------*/
        Route::get('intros', [
            'uses'      => 'IntroController@index',
            'as'        => 'intros.index',
            'title'     => 'definition_pages',
            'icon'      => '<i class="feather icon-loader"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['intros.show', 'intros.create', 'intros.store', 'intros.edit', 'intros.update', 'intros.delete', 'intros.deleteAll'],
        ]);

        # intros update
        Route::get('intros/{id}/Show', [
            'uses'  => 'IntroController@show',
            'as'    => 'intros.show',
            'title' => 'view_a_profile_page',
        ]);

        # intros store
        Route::get('intros/create', [
            'uses'  => 'IntroController@create',
            'as'    => 'intros.create',
            'title' => 'add_a_profile_page',
        ]);

        # intros store
        Route::post('intros/store', [
            'uses'  => 'IntroController@store',
            'as'    => 'intros.store',
            'title' => 'add_a_profile_page',
        ]);

        # intros update
        Route::get('intros/{id}/edit', [
            'uses'  => 'IntroController@edit',
            'as'    => 'intros.edit',
            'title' => 'edit_a_profile_page',
        ]);

        # intros update
        Route::put('intros/{id}', [
            'uses'  => 'IntroController@update',
            'as'    => 'intros.update',
            'title' => 'edit_a_profile_page',
        ]);

        # intros delete
        Route::delete('intros/{id}', [
            'uses'  => 'IntroController@destroy',
            'as'    => 'intros.delete',
            'title' => 'delete_a_profile_page',
        ]);
        #delete all intros
        Route::post('delete-all-intros', [
            'uses'  => 'IntroController@destroyAll',
            'as'    => 'intros.deleteAll',
            'title' => 'delete_amultible_profile_page',
        ]);
        /*------------ end Of intros ----------*/

        /*------------ start Of seos ----------*/
        Route::get('seos', [
            'uses'  => 'SeoController@index',
            'as'    => 'seos.index',
            'title' => 'seo',
            'icon'  => '<i class="feather icon-list"></i>',
            // 'type'  => 'parent',
            // 'child' => [
            //     'seos.show', 'seos.create', 'seos.edit', 'seos.index', 'seos.store', 'seos.update', 'seos.delete', 'seos.deleteAll',
            // ],
        ]);
        # seos update
        Route::get('seos/{id}/Show', [
            'uses'  => 'SeoController@show',
            'as'    => 'seos.show',
            'title' => 'view_seo',
        ]);

        # seos store
        Route::get('seos/create', [
            'uses'  => 'SeoController@create',
            'as'    => 'seos.create',
            'title' => 'add_seo',
        ]);

        # seos update
        Route::get('seos/{id}/edit', [
            'uses'  => 'SeoController@edit',
            'as'    => 'seos.edit',
            'title' => 'edit_seo',
        ]);

        #store
        Route::post('seos/store', [
            'uses'  => 'SeoController@store',
            'as'    => 'seos.store',
            'title' => 'add_seo',
        ]);

        #update
        Route::put('seos/{id}', [
            'uses'  => 'SeoController@update',
            'as'    => 'seos.update',
            'title' => 'edit_seo',
        ]);

        #deletّe
        Route::delete('seos/{id}', [
            'uses'  => 'SeoController@destroy',
            'as'    => 'seos.delete',
            'title' => 'delete_seo',
        ]);
        #delete
        Route::post('delete-all-seos', [
            'uses'  => 'SeoController@destroyAll',
            'as'    => 'seos.deleteAll',
            'title' => 'delete_multible_seo',
        ]);
        /*------------ end Of seos ----------*/


        /*------------ start Of statistics ----------*/
        // Route::get('statistics', [
        //     'uses'  => 'StatisticsController@index',
        //     'as'    => 'statistics.index',
        //     'title' => 'Statistics',
        //     'icon'  => '<i class="feather icon-activity"></i>',
        //     // 'type'  => 'parent',
        //     // 'child' => [
        //     //     'statistics.index',
        //     // ],
        // ]);
        /*------------ end Of statistics ----------*/        
        /*------------ start Of countries ----------*/
        Route::get('countries-cities', [
            'as'        => 'countries_cities',
            'icon'      => '<i class="fa fa-map-marker"></i>',
            'title'     => 'countries_cities',
            'type'      => 'parent',
            'sub_route' => true,
            'child'     => [
                'countries.index','countries.show', 'countries.create', 'countries.store', 'countries.edit', 'countries.update', 'countries.delete', 'countries.deleteAll',
                'regions.index','regions.create', 'regions.store', 'regions.edit', 'regions.update', 'regions.show', 'regions.delete', 'regions.deleteAll',
                'cities.index','cities.create', 'cities.store', 'cities.edit', 'cities.show', 'cities.update', 'cities.delete', 'cities.deleteAll','cities.get-country-regions' 
            ],
        ]);

        Route::get('countries', [
            'uses'      => 'CountryController@index',
            'as'        => 'countries.index',
            'title'     => 'countries',
            'icon'      => '<i class="feather icon-flag"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['countries.show', 'countries.create', 'countries.store', 'countries.edit', 'countries.update', 'countries.delete', 'countries.deleteAll'],
        ]);

        Route::get('countries/{id}/show', [
            'uses'  => 'CountryController@show',
            'as'    => 'countries.show',
            'title' => 'view_country',
        ]);

        # countries store
        Route::get('countries/create', [
            'uses'  => 'CountryController@create',
            'as'    => 'countries.create',
            'title' => 'add_country',
        ]);

        # countries store
        Route::post('countries/store', [
            'uses'  => 'CountryController@store',
            'as'    => 'countries.store',
            'title' => 'add_country',
        ]);

        # countries update
        Route::get('countries/{id}/edit', [
            'uses'  => 'CountryController@edit',
            'as'    => 'countries.edit',
            'title' => 'edit_country',
        ]);

        # countries update
        Route::put('countries/{id}', [
            'uses'  => 'CountryController@update',
            'as'    => 'countries.update',
            'title' => 'edit_country',
        ]);

        # countries delete
        Route::delete('countries/{id}', [
            'uses'  => 'CountryController@destroy',
            'as'    => 'countries.delete',
            'title' => 'delete_country',
        ]);
        #delete all countries
        Route::post('delete-all-countries', [
            'uses'  => 'CountryController@destroyAll',
            'as'    => 'countries.deleteAll',
            'title' => 'delete_multible_country',
        ]);
        /*------------ end Of countries ----------*/

        /*------------ start Of regions ----------*/
        Route::get('regions', [
            'uses'      => 'RegionController@index',
            'as'        => 'regions.index',
            'title'     => 'regions',
            'icon'      => '<i class="fa fa-map-marker"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['regions.create', 'regions.store', 'regions.edit', 'regions.update', 'regions.show', 'regions.delete', 'regions.deleteAll'],
        ]);

        # regions store
        Route::get('regions/create', [
            'uses'  => 'RegionController@create',
            'as'    => 'regions.create',
            'title' => 'add_region_page',
        ]);

        # regions store
        Route::post('regions/store', [
            'uses'  => 'RegionController@store',
            'as'    => 'regions.store',
            'title' => 'add_region',
        ]);

        # regions update
        Route::get('regions/{id}/edit', [
            'uses'  => 'RegionController@edit',
            'as'    => 'regions.edit',
            'title' => 'update_region_page',
        ]);

        # regions update
        Route::put('regions/{id}', [
            'uses'  => 'RegionController@update',
            'as'    => 'regions.update',
            'title' => 'update_region',
        ]);

        # regions show
        Route::get('regions/{id}/Show', [
            'uses'  => 'RegionController@show',
            'as'    => 'regions.show',
            'title' => 'show_region_page',
        ]);

        # regions delete
        Route::delete('regions/{id}', [
            'uses'  => 'RegionController@destroy',
            'as'    => 'regions.delete',
            'title' => 'delete_region',
        ]);
        #delete all regions
        Route::post('delete-all-regions', [
            'uses'  => 'RegionController@destroyAll',
            'as'    => 'regions.deleteAll',
            'title' => 'delete_group_of_regions',
        ]);
/*------------ end Of regions ----------*/

        /*------------ start Of cities ----------*/
        Route::get('cities', [
            'uses'      => 'CityController@index',
            'as'        => 'cities.index',
            'title'     => 'cities',
            'icon'      => '<i class="feather icon-globe"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['cities.create', 'cities.store', 'cities.edit', 'cities.show', 'cities.update', 'cities.delete', 'cities.deleteAll'],
        ]);

        # cities store
        Route::get('cities/create', [
            'uses'  => 'CityController@create',
            'as'    => 'cities.create',
            'title' => 'add_city',
        ]);

        # cities store
        Route::post('cities/store', [
            'uses'  => 'CityController@store',
            'as'    => 'cities.store',
            'title' => 'add_city',
        ]);

        # cities update
        Route::get('cities/{id}/edit', [
            'uses'  => 'CityController@edit',
            'as'    => 'cities.edit',
            'title' => 'edit_city',
        ]);

        # cities update
        Route::put('cities/{id}', [
            'uses'  => 'CityController@update',
            'as'    => 'cities.update',
            'title' => 'edit_city',
        ]);

        Route::get('cities/{id}/show', [
            'uses'  => 'CityController@show',
            'as'    => 'cities.show',
            'title' => 'view_city',
        ]);

        # cities delete
        Route::delete('cities/{id}', [
            'uses'  => 'CityController@destroy',
            'as'    => 'cities.delete',
            'title' => 'delete_city',
        ]);
        #delete all cities
        Route::post('delete-all-cities', [
            'uses'  => 'CityController@destroyAll',
            'as'    => 'cities.deleteAll',
            'title' => 'delete_multible_city',
        ]);

        Route::get('get-country-regions', [
            'uses'  => 'CityController@getCountryRegions',
            'as'    => 'cities.get-country-regions',
            'title' => 'get_country_regions'
        ]); 
        /*------------ end Of cities ----------*/
        /*------------ start Of Settings----------*/
        Route::get('all-settings', [
            'as'        => 'all_settings',
            'icon'      => '<i class="feather icon-settings"></i>',
            'title'     => 'all_settings',
            'type'      => 'parent',
            'sub_route' => true,
            'child'     => [
                'fqs.index','fqs.show', 'fqs.create', 'fqs.store', 'fqs.edit', 'fqs.update', 'fqs.delete', 'fqs.deleteAll',
                'all_complaints','complaints.delete', 'complaints.deleteAll', 'complaints.show', 'complaint.replay',
                // 'sms.index','sms.update', 'sms.change',
                'roles.index', 'roles.create', 'roles.store', 'roles.edit', 'roles.update', 'roles.delete',
                'reports.index','reports.delete', 'reports.deleteAll', 'reports.show',
                'settings.index', 'settings.update', 'settings.message.all', 'settings.message.one', 'settings.send_email',
                'apphomes.index','apphomes.create', 'apphomes.store','apphomes.edit', 'apphomes.update', 'apphomes.show', 'apphomes.delete'  ,'apphomes.deleteAll' ,'apphomes.get-records-by-type',
            ],
        ]);
        /*------------ start Of fqs ----------*/
        Route::get('fqs', [
            'uses'      => 'FqsController@index',
            'as'        => 'fqs.index',
            'title'     => 'questions_sections',
            'icon'      => '<i class="feather icon-alert-circle"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['fqs.show', 'fqs.create', 'fqs.store', 'fqs.edit', 'fqs.update', 'fqs.delete', 'fqs.deleteAll'],
        ]);

        Route::get('fqs/{id}/show', [
            'uses'  => 'FqsController@show',
            'as'    => 'fqs.show',
            'title' => 'view_question',
        ]);

        # fqs store
        Route::get('fqs/create', [
            'uses'  => 'FqsController@create',
            'as'    => 'fqs.create',
            'title' => 'add_question',
        ]);

        # fqs store
        Route::post('fqs/store', [
            'uses'  => 'FqsController@store',
            'as'    => 'fqs.store',
            'title' => 'add_question',
        ]);

        # fqs update
        Route::get('fqs/{id}/edit', [
            'uses'  => 'FqsController@edit',
            'as'    => 'fqs.edit',
            'title' => 'edit_question',
        ]);

        # fqs update
        Route::put('fqs/{id}', [
            'uses'  => 'FqsController@update',
            'as'    => 'fqs.update',
            'title' => 'edit_question',
        ]);

        # fqs delete
        Route::delete('fqs/{id}', [
            'uses'  => 'FqsController@destroy',
            'as'    => 'fqs.delete',
            'title' => 'delete_question',
        ]);
        #delete all fqs
        Route::post('delete-all-fqs', [
            'uses'  => 'FqsController@destroyAll',
            'as'    => 'fqs.deleteAll',
            'title' => 'delete_multible_question',
        ]);
        /*------------ end Of fqs ----------*/
        /*------------ start Of complaints ----------*/
        Route::get('all-complaints', [
            'as'        => 'all_complaints',
            'uses'      => 'ComplaintController@index',
            'icon'      => '<i class="feather icon-mail"></i>',
            'title'     => 'complaints_and_proposals',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => [
            //     'complaints.delete', 'complaints.deleteAll', 'complaints.show', 'complaint.replay',
            // ],
        ]);

        # complaint replay
        Route::post('complaints-replay/{id}', [
            'uses'  => 'ComplaintController@replay',
            'as'    => 'complaint.replay',
            'title' => 'the_replay_of_complaining_or_proposal',
        ]);
        # socials update
        Route::get('complaints/{id}', [
            'uses'  => 'ComplaintController@show',
            'as'    => 'complaints.show',
            'title' => 'the_resolution_of_complaining_or_proposal',
        ]);

        # complaints delete
        Route::delete('complaints/{id}', [
            'uses'  => 'ComplaintController@destroy',
            'as'    => 'complaints.delete',
            'title' => 'delete_complaining',
        ]);

        #delete all complaints
        Route::post('delete-all-complaints', [
            'uses'  => 'ComplaintController@destroyAll',
            'as'    => 'complaints.deleteAll',
            'title' => 'delete_multibles_complaining',
        ]);
        /*------------ end Of complaints ----------*/
         /*------------ start Of sms ----------*/
         Route::get('sms', [
            'uses'      => 'SMSController@index',
            'as'        => 'sms.index',
            'title'     => 'message_packages',
            'icon'      => '<i class="feather icon-smartphone"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['sms.update', 'sms.change'],
        ]);
        # sms change
        Route::post('sms-change', [
            'uses'  => 'SMSController@change',
            'as'    => 'sms.change',
            'title' => 'message_update',
        ]);
        # sms update
        Route::put('sms/{id}', [
            'uses'  => 'SMSController@update',
            'as'    => 'sms.update',
            'title' => 'message_update',
        ]);
        /*------------ end Of sms ----------*/
        /*------------ start Of Roles----------*/
        Route::get('roles', [
            'uses'  => 'RoleController@index',
            'as'    => 'roles.index',
            'title' => 'Validities_list',
            'icon'  => '<i class="feather icon-eye"></i>',
            // 'type'  => 'parent',
            // 'child' => [
            //     'roles.index', 'roles.create', 'roles.store', 'roles.edit', 'roles.update', 'roles.delete',
            // ],
        ]);

        #add role page
        Route::get('roles/create', [
            'uses'  => 'RoleController@create',
            'as'    => 'roles.create',
            'title' => 'add_role',

        ]);

        #store role
        Route::post('roles/store', [
            'uses'  => 'RoleController@store',
            'as'    => 'roles.store',
            'title' => 'add_role',
        ]);

        #edit role page
        Route::get('roles/{id}/edit', [
            'uses'  => 'RoleController@edit',
            'as'    => 'roles.edit',
            'title' => 'edit_role',
        ]);

        #update role
        Route::put('roles/{id}', [
            'uses'  => 'RoleController@update',
            'as'    => 'roles.update',
            'title' => 'edit_role',
        ]);

        #delete role
        Route::delete('roles/{id}', [
            'uses'  => 'RoleController@destroy',
            'as'    => 'roles.delete',
            'title' => 'delete_role',
        ]);
        /*------------ end Of Roles----------*/
        /*------------ start Of reports----------*/
        Route::get('reports', [
            'uses'      => 'ReportController@index',
            'as'        => 'reports.index',
            'icon'      => '<i class="feather icon-edit-2"></i>',
            'title'     => 'reports',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['reports.delete', 'reports.deleteAll', 'reports.show'],
        ]);

        # reports show
        Route::get('reports/{id}', [
            'uses'  => 'ReportController@show',
            'as'    => 'reports.show',
            'title' => 'show_report',
        ]);
        # reports delete
        Route::delete('reports/{id}', [
            'uses'  => 'ReportController@destroy',
            'as'    => 'reports.delete',
            'title' => 'delete_report',
        ]);

        #delete all reports
        Route::post('delete-all-reports', [
            'uses'  => 'ReportController@destroyAll',
            'as'    => 'reports.deleteAll',
            'title' => 'delete_multible_report',
        ]);
        /*------------ end Of reports ----------*/
        Route::get('settings', [
            'uses'  => 'SettingController@index',
            'as'    => 'settings.index',
            'title' => 'setting',
            'icon'  => '<i class="feather icon-settings"></i>',
            // 'type'  => 'parent',
            // 'child' => [
            //     'settings.index', 'settings.update', 'settings.message.all', 'settings.message.one', 'settings.send_email',
            // ],
        ]);

        #update
        Route::put('settings', [
            'uses'  => 'SettingController@update',
            'as'    => 'settings.update',
            'title' => 'edit_setting',
        ]);

        #message all
        Route::post('settings/{type}/message-all', [
            'uses'  => 'SettingController@messageAll',
            'as'    => 'settings.message.all',
            'title' => 'message_all',
        ])->where('type', 'email|sms|notification');

        #message one
        Route::post('settings/{type}/message-one', [
            'uses'  => 'SettingController@messageOne',
            'as'    => 'settings.message.one',
            'title' => 'message_one',
        ])->where('type', 'email|sms|notification');

        #send email
        Route::post('settings/send-email', [
            'uses'  => 'SettingController@sendEmail',
            'as'    => 'settings.send_email',
            'title' => 'send_email',
        ]);
        /*------------ end Of Settings ----------*/
       
    
    /*------------ start Of apphomes ----------*/
        Route::get('apphomes', [
            'uses'      => 'AppHomeController@index',
            'as'        => 'apphomes.index',
            'title'     => 'apphomes',
            'icon'      => '<i class="feather icon-image"></i>',
            // 'type'      => 'parent',
            // 'sub_route' => false,
            // 'child'     => ['apphomes.create', 'apphomes.store','apphomes.edit', 'apphomes.update', 'apphomes.show', 'apphomes.delete'  ,'apphomes.deleteAll' ,'apphomes.get-records-by-type']
        ]);

        Route::get('get-records-by-type', [
            'uses'  => 'AppHomeController@getRecordsByType',
            'as'    => 'apphomes.get-records-by-type',
            'title' => 'get_records_by_type'
        ]); 

        # apphomes store
        Route::get('apphomes/create', [
            'uses'  => 'AppHomeController@create',
            'as'    => 'apphomes.create',
            'title' => 'add_apphome_page'
        ]);


        # apphomes store
        Route::post('apphomes/store', [
            'uses'  => 'AppHomeController@store',
            'as'    => 'apphomes.store',
            'title' => 'add_apphome'
        ]);

        # apphomes update
        Route::get('apphomes/{id}/edit', [
            'uses'  => 'AppHomeController@edit',
            'as'    => 'apphomes.edit',
            'title' => 'update_apphome_page'
        ]);

        # apphomes update
        Route::put('apphomes/{id}', [
            'uses'  => 'AppHomeController@update',
            'as'    => 'apphomes.update',
            'title' => 'update_apphome'
        ]);

        # apphomes show
        Route::get('apphomes/{id}/Show', [
            'uses'  => 'AppHomeController@show',
            'as'    => 'apphomes.show',
            'title' => 'show_apphome_page'
        ]);

        # apphomes delete
        Route::delete('apphomes/{id}', [
            'uses'  => 'AppHomeController@destroy',
            'as'    => 'apphomes.delete',
            'title' => 'delete_apphome'
        ]);
        #delete all apphomes
        Route::post('delete-all-apphomes', [
            'uses'  => 'AppHomeController@destroyAll',
            'as'    => 'apphomes.deleteAll',
            'title' => 'delete_group_of_apphomes'
        ]);
    /*------------ end Of apphomes ----------*/
    #new_routes_here
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
    });

    /// excel area
    Route::get(
        'export/{export}',
        'ExcelController@master'
    )->name('master-export');
    Route::get(
        'export-transactions',
        'ExcelController@transactionsExport'
    )->name('export-transactions');
    Route::post('import-items', 'ExcelController@importItems')->name('import-items');
    Route::get('{model}/toggle-boolean/{id}/{action}', 'AdminController@toggleBoolean')->name('model.active');

});