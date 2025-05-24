<?php

namespace App\Traits;

trait menu {
  public function home() {

    $menu = [
      [
        'name'  => __('admin.admins'),
        'count' => \App\Models\Admin::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/admins'),
      ], [
        'name'  => __('admin.clients'),
        'count' => \App\Models\User::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients'),
      ], [
        'name'  => __('admin.active_users'),
        'count' => \App\Models\User::where('active', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients'),
      ], [
        'name'  =>  __('admin.dis_active_users'),
        'count' => \App\Models\User::where('active', 0)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients'),
      ], [
        'name'  => __('admin.Unspoken_users'),
        'count' => \App\Models\User::where('is_blocked', 0)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients'),
      ], [
        'name'  => __('admin.Prohibited_users'),
        'count' => \App\Models\User::where('is_blocked', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients'),
      ], [
        'name'  => __('admin.providers'),
        'count' => \App\Models\Provider::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/providers'),
      ], [
        'name'  => __('admin.services-sections'),
        'count' => \App\Models\Category::where('type','service')->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/services-categories-show'),
      ], [
        'name'  => __('admin.services-sections'),
        'count' => \App\Models\Category::where('type','place')->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/places-categories-show'),
      ], [
        'name'  => __('admin.services'),
        'count' => \App\Models\Service::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/services'),
      ], [
        'name'  => __('admin.places'),
        'count' => \App\Models\Place::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/places'),
      ], [
        'name'  => __('admin.meetingrooms'),
        'count' => \App\Models\MeetingRoom::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/meetingrooms'),
      ], [
        'name'  => __('admin.reservations'),
        'count' => \App\Models\Order::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/orders'),
      ], [
        'name'  => __('admin.service-ratings'),
        'count' => \App\Models\ServiceRating::count(),
        'icon'  => 'icon-star',
        'url'   => url('admin/service-ratings'),
      ], [
        'name'  => __('admin.place-ratings'),
        'count' => \App\Models\PlaceRating::count(),
        'icon'  => 'icon-star',
        'url'   => url('admin/place-ratings'),
      ], [
        'name'  => __('admin.provider-ratings'),
        'count' => \App\Models\ProviderRating::count(),
        'icon'  => 'icon-star',
        'url'   => url('admin/provider-ratings'),
      ],  
      

      
      [
        'name'  => __('admin.socials'),
        'count' => \App\Models\Social::count(),
        'icon'  => 'icon-thumbs-up',
        'url'   => url('admin/socials'),
      ], [
        'name'  => __('admin.complaints_and_proposals'),
        'count' => \App\Models\Complaint::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/all-complaints'),
      ], [
        'name'  => __('admin.reports'),
        'count' => \App\Models\LogActivity::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/reports'),
      ], [
        'name'  => __('admin.countries'),
        'count' => \App\Models\Country::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/countries'),
      ],
      [
        'name'  => __('admin.regions'),
        'count' => \App\Models\Region::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/regions'),
      ],
      [
        'name'  => __('admin.cities'),
        'count' => \App\Models\City::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/cities'),
      ], [
        'name'  => __("admin.common_questions"),
        'count' => \App\Models\Fqs::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/fqs'),
      ], [
        'name'  => __('admin.definition_pages'),
        'count' => \App\Models\Intro::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/intros'),
      ], [
        'name'  => __('admin.advertising_banners'),
        'count' => \App\Models\Image::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/images'),
      ],[
        'name'  => __('admin.Validities'),
        'count' => \App\Models\Role::count(),
        'icon'  => 'icon-eye',
        'url'   => url('admin/roles'),
      ],
    ];

    return $menu;
  }

  public function introSiteCards() {
    $menu = [
      [
        'name'  => __('admin.insolder'),
        'count' => \App\Models\IntroSlider::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introsliders'),
      ],
      [
        'name'  => __('admin.Service_Suite'),
        'count' => \App\Models\IntroService::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introservices'),
      ],
      [
        'name'  => __('admin.questions_sections'),
        'count' => \App\Models\IntroFqsCategory::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introfqscategories'),
      ],
      [
        'name'  => __('admin.common_questions'),
        'count' => \App\Models\IntroFqs::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introfqs'),
      ],
      [
        'name'  => __('admin.Success_Partners'),
        'count' => \App\Models\IntroPartener::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introparteners'),
      ],
      [
        'name'  => __('admin.Customer_messages'),
        'count' => \App\Models\IntroMessages::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/intromessages'),
      ],
      [
        'name'  => __('admin.socials'),
        'count' => \App\Models\IntroSocial::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introsocials'),
      ],
      [
        'name'  => __('admin.how_the_site_works_section'),
        'count' => \App\Models\IntroHowWork::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introhowworks'),
      ],
    ];
    return $menu;
  }

}