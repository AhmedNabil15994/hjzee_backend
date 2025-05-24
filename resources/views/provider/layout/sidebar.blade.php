    <section class="sidebar">
        <div class="logohead">
            {{-- <img class="logo" src="{{ $settings['logo'] }}"> --}}
            <img class="headpor" src="{{auth('provider')->user()->image}}">
            <h6>{{auth('provider')->user()->name}}</h6>
        </div>
        <div class="sidenav mt-4">
            <ul class="p-0">
                <li class="{{ (\Request::route()->getName() == 'provider.index')? 'act':''}} ">
                    <a class="sidenav-link" href="{{route('provider.index')}}">
                        <div style="width:60%;margin:auto" class="d-flex align-items-center">
                            <img class="actimg" src="{{asset('provider/images/homeact.png')}}">
                            <img class="gryimg" src="{{asset('provider/images/home.png')}}">
                            <p class="mb-0 mr-3 ml-3">{{__('provider.Main')}}</p>
                        </div>
                    </a>
                </li>
                <li class="{{ (\Request::route()->getName() == 'provider.profile')? 'act':''}}">
                    <a class="sidenav-link" href="{{route('provider.profile')}}">
                        <div style="width:60%;margin:auto" class="d-flex align-items-center">
                            <img class="actimg" src="{{asset('provider/images/useract.png')}}">
                            <img class="gryimg" src="{{asset('provider/images/user.png')}}">
                            <p class="mb-0 mr-3 ml-3">{{__('provider.Profile')}}</p>
                        </div>
                    </a>
                </li>
                <?php $authPermissions = (auth('provider')->check()) ? auth('provider')->user()->employee_permissions : [];?>
                {{-- @if(auth('provider')->user()->type == 'place') --}}
                @if(in_array('provider.places', $authPermissions??[]))
                    <li class="{{ (\Request::route()->getName() == 'provider.places')? 'act':''}}">
                        <a class="sidenav-link" href="{{route('provider.places')}}">
                            <div style="width:60%;margin:auto" class="d-flex align-items-center">
                                <img class="actimg" src="{{asset('provider/images/useract.png')}}">
                                <img class="gryimg" src="{{asset('provider/images/user.png')}}">
                                <p class="mb-0 mr-3 ml-3">{{__('admin.places')}}</p>
                            </div>
                        </a>
                    </li>
                @endif
                @if(in_array('provider.addPlaceReservation', $authPermissions??[]))
                    <li class="{{(\Request::route()->getName() == 'provider.addPlaceReservation')? 'act' : ''}}">
                        <a class="sidenav-link" href="{{route('provider.addPlaceReservation')}}">
                            <div style="width:60%;margin:auto" class="d-flex align-items-center">
                                <img class="actimg" src="{{asset('provider/images/pencil.png')}}">
                                <img class="gryimg" src="{{asset('provider/images/pencil.png')}}">
                                <p class="mb-0 mr-3 ml-3">{{__('provider.add_place_reservation')}}</p>
                            </div>
                        </a>
                    </li>
                @endif
                @if(in_array('provider.new', $authPermissions??[]))

                    <li class="{{(\Request::route()->getName() == 'provider.new')? 'act' : ''}}">
                        <a class="sidenav-link" href="{{route('provider.new')}}">
                            <div style="width:60%;margin:auto" class="d-flex align-items-center">
                                <img class="actimg" src="{{asset('provider/images/reservatact.png')}}">
                                <img class="gryimg" src="{{asset('provider/images/reservat.png')}}">
                                <p class="mb-0 mr-3 ml-3">{{__('provider.new_place_reservations')}}</p>
                            </div>
                        </a>
                    </li>
                @endif
                @if(in_array('provider.finished', $authPermissions??[]))

                    <li class="{{(\Request::route()->getName() == 'provider.finished')? 'act' : ''}}">
                        <a class="sidenav-link" href="{{route('provider.finished')}}">
                            <div style="width:60%;margin:auto" class="d-flex align-items-center">
                                <img class="actimg" src="{{asset('provider/images/reservatact.png')}}">
                                <img class="gryimg" src="{{asset('provider/images/reservat.png')}}">
                                <p class="mb-0 mr-3 ml-3">{{__('provider.finished_place_reservations')}}</p>
                            </div>
                        </a>
                    </li>
                @endif

                {{-- @elseif(auth('provider')->user()->type == 'service') --}}
                @if(in_array('provider.services', $authPermissions??[]))
                    <li class="{{ (\Request::route()->getName() == 'provider.services')? 'act':''}}">
                        <a class="sidenav-link" href="{{route('provider.services')}}">
                            <div style="width:60%;margin:auto" class="d-flex align-items-center">
                                <img class="actimg" src="{{asset('provider/images/useract.png')}}">
                                <img class="gryimg" src="{{asset('provider/images/user.png')}}">
                                <p class="mb-0 mr-3 ml-3">{{__('admin.services')}}</p>
                            </div>
                        </a>
                    </li>
                @endif
                @if(in_array('provider.addServiceReservation', $authPermissions??[]))
                    <li class="{{(\Request::route()->getName() == 'provider.addServiceReservation')? 'act' : ''}}">
                        <a class="sidenav-link" href="{{route('provider.addServiceReservation')}}">
                            <div style="width:60%;margin:auto" class="d-flex align-items-center">
                                <img class="actimg" src="{{asset('provider/images/pencil.png')}}">
                                <img class="gryimg" src="{{asset('provider/images/pencil.png')}}">
                                <p class="mb-0 mr-3 ml-3">{{__('provider.add_service_reservation')}}</p>
                            </div>
                        </a>
                    </li>
                @endif
                @if(in_array('provider.reservations', $authPermissions??[]))
                    <li class="{{(\Request::route()->getName() == 'provider.reservations')? 'act' : ''}}">
                        <a class="sidenav-link" href="{{route('provider.reservations')}}">
                            <div style="width:60%;margin:auto" class="d-flex align-items-center">
                                <img class="actimg" src="{{asset('provider/images/reservatact.png')}}">
                                <img class="gryimg" src="{{asset('provider/images/reservat.png')}}">
                                <p class="mb-0 mr-3 ml-3">{{__('provider.service_reservations')}}</p>
                            </div>
                        </a>
                    </li>
                @endif
                {{-- @endif --}}


                {{-- <li class="{{(\Request::route()->getName() == 'provider.payments')? 'act' : ''}}">
                    <a class="sidenav-link" href="{{route('provider.payments')}}">
                        <div style="width:60%;margin:auto" class="d-flex align-items-center">
                            <img class="actimg" src="{{asset('provider/images/walletact.png')}}">
                            <img class="gryimg" src="{{asset('provider/images/wallet.png')}}">
                            <p class="mb-0 mr-3 ml-3">{{__('provider.financial operations')}}</p>
                        </div>
                    </a>
                </li> --}}
                @if(in_array('provider.employees', $authPermissions??[]))
                <li class="{{(\Request::route()->getName() == 'provider.employees' || \Request::route()->getName() == 'provider.addEmployee')? 'act' : ''}}">
                    <a class="sidenav-link" href="{{route('provider.employees')}}">
                        <div style="width:60%;margin:auto" class="d-flex align-items-center">
                            <img class="actimg" src="{{asset('provider/images/imployeact.png')}}">
                            <img class="gryimg" src="{{asset('provider/images/imploye.png')}}">
                            <p class="mb-0 mr-3 ml-3">{{__('provider.Employees')}}</p>
                        </div>
                    </a>
                </li>
                @endif

                <li class="{{(\Request::route()->getName() == 'provider.settings')? 'act' : ''}}">
                    <a class="sidenav-link" href="{{route('provider.settings')}}">
                        <div style="width:60%;margin:auto" class="d-flex align-items-center">
                            <img class="actimg" src="{{asset('provider/images/settingact.png')}}">
                            <img class="gryimg" src="{{asset('provider/images/setting.png')}}">
                            <p class="mb-0 mr-3 ml-3">{{__('provider.settings')}}</p>
                        </div>
                    </a>
                </li>
                <li class="{{(\Request::route()->getName() == 'provider.contactus')? 'act' : ''}}">
                    <a class="sidenav-link" href="{{route('provider.contactus')}}">
                        <div style="width:60%;margin:auto" class="d-flex align-items-center">
                            <img class="actimg" src="{{asset('provider/images/contactact.png')}}">
                            <img class="gryimg" src="{{asset('provider/images/contact.png')}}">
                            <p class="mb-0 mr-3 ml-3">{{__('provider.Connect with us')}}</p>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a class="sidenav-link" href="#" onclick="logoutForm.submit();return false;">
                        <div style="width:60%;margin:auto" class="d-flex align-items-center">
                            <img src="{{asset('provider/images/log-out.png')}}">
                            <p class="mb-0 mr-3 ml-3">{{__('auth.logout')}}</p>
                            <form action="{{route('provider.logoutProvider')}}" method="POST" id="logoutForm">
                                {{csrf_field()}}
                            </form>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </section>
