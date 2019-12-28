@extends('joodyasell.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline" dir="rtl">
                <div class="media">
                    <div class="mr-3">
                        <a href="#">
                            <img src="{{url('/upload/restaurants/' .App\Restaurants::where('user_id',Auth::user()->id)->first()->restaurant_logo .'-b.jpg')}}" class="rounded-circle" width="42" height="42" alt="">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="mb-0">{{App\Restaurants::where('user_id',Auth::user()->id)->first()->restaurant_name}}</h6>
                        <span class="text-muted">{{App\Restaurants::where('user_id',Auth::user()->id)->first()->city}}</span>
                    </div>

                </div>
                <div class="header-elements">
                    <div class="list-icons">
                        <a href="{{url('joodyasell')}}" class="list-icons-item"><i class="icon icon-database-refresh"></i></a>
                    </div>
                </div>

        </div>

        <div class="card-body">
            <ul class="nav nav-tabs" dir="rtl">
                <li class="nav-item"><a href="#basic-tab1" class="nav-link active show" data-toggle="tab">
                        <span class="badge bg-danger-400 badge-pill badge-float border-2 border-white">جديد</span>


                        <div class="mr-3 position-relative">
                            <img src="{{url('/images/notification.png')}}" class="rounded-circle" width="36" height="36" alt="">
                            <span id="new_order" class="badge bg-danger-400 badge-pill badge-float border-2 border-white">{{count($newOrders)}}</span>

                        </div>
                    </a></li>
                <li class="nav-item"><a href="#basic-tab2" class="nav-link" data-toggle="tab">
                        <span class="badge bg-danger-400 badge-pill badge-float border-2 border-white">ارشيف</span>

                        <div class="mr-3 position-relative">
                            <img src="{{url('/images/notification_archive.png')}}" class="rounded-circle" width="36" height="36" alt="">
                            <span class="badge bg-danger-400 badge-pill badge-float border-2 border-white">{{count($archiveOrders)}}</span>

                        </div>

                    </a></li>
                <li class="nav-item"><a href="#basic-tab3" class="nav-link" data-toggle="tab">

                        <span class="badge bg-danger-400 badge-pill badge-float border-2 border-white">المنيو</span>

                        <div class="mr-3 position-relative">
                            <img src="{{url('/images/menu.png')}}" class="rounded-circle" width="36" height="36" alt="">
                            <span class="badge bg-danger-400 badge-pill badge-float border-2 border-white">
                                @if(Auth::User()->usertype == 'Admin')
                                    {{count(App\Menu::where('offer',1)->get())}}

                                @else
                                {{count(App\Menu::where('restaurant_id',App\Restaurants::where('user_id',Auth::user()->id)->first()->id)->get())}}
                                    @endif
                            </span>

                        </div>
                    </a></li>

            </ul>

            <div class="tab-content">
                <div class="tab-pane fade active show" id="basic-tab1">
                    <h4>طلبات جديدة</h4>

                    @include('joodyasell.newOrder')
                </div>

                <div class="tab-pane fade" id="basic-tab2">
                    <div class="tab-pane fade active show" id="tab-light-1">
                        <h4>أرشيف الطلبات</h4>
                          @include('joodyasell.orderArchive')


                    </div>


                </div>

                <div class="tab-pane fade" id="basic-tab3">
                    <div class="tab-pane fade active show" id="tab-light-1">
                        <h3>قائمة الطعام</h3>

                        @include('joodyasell.restaurantMenu')
                    </div>
                </div>

                <div class="tab-pane fade" id="basic-tab4">
                    Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
                </div>
            </div>
        </div>
    </div>
@endsection
