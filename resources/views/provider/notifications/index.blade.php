@extends('provider.layout.master')
@section('content')
    <!-- content of the page -->
    <div class="content content2">
      <section id="alerts" class="mx-5 mt-5 mb-5">
        <div class="row">
          <div class="col-md-6">
        @if($notifications->count())
            @foreach($notifications as $notification)
            <!-- single alert -->
            <div class="alert animation mb-4">
              <a href="#" class="d-flex justify-content-start align-items-center px-3">
                <!-- alert icon -->
                <span class="alert-icon">
                  <i class="fa-solid fa-bell"></i>
                </span>
                <!-- alert details -->
                <div class="flex-col justify-content-start align-items-start">
                  <span class="black-color accept mb-1">{{$notification->body}}</span>
                  <span class="gray-color"> {{$notification->created_at->diffForHumans()}}</span>
                </div>
              </a>
            </div>
            @endforeach
            {{$notifications->links()}}
          </div>
        @else
        <div class="page-contant mt-4">
            <div class="container">
                <div class="overflow-hidden">
                    <div class="notification">
                        <p>{{ __('provider.no_notifications') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
          
        @if($notifications->count())
          <!-- delete all -->
          <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <form action="{{route('provider.delete-notifications')}}" method="POST" id="form">
                  {{csrf_field()}}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn button button4" style="padding: 8px 43px" onclick="return confirm({{ __('provider.sure') }});return false;">{{ __('provider.delete_all') }}</button>
                </form>
            </div>
          </div>
        @endif
        </div>
      </section>
    </div>
@endsection

