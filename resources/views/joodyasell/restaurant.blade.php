@extends('mobile.layouts.app')
@section('content')
            <div class="row">
                <div class="col-xl-6">

                    <div class="mb-3" style="text-align: center">
                        <div class="page-header page-header-light has-cover" style="border: 1px solid #ddd;">
                            <div class="page-header-content header-elements-inline">
                                <div class="page-title" style="text-align: center">
                                    <img src="{{url('upload/res_logo.png')}}" alt="" style="border-radius: 10rem">
                                    <h5>{{$restaurant->restaurant_name}}</h5>


                                </div>

                            </div>

                            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                                <div class="d-flex">
                                    <div class="breadcrumb">
                                        <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                                        <a href="components_page_header.html" class="breadcrumb-item">Current</a>
                                        <span class="breadcrumb-item active">Location</span>
                                    </div>

                                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                                </div>

                                <div class="header-elements d-none">
                                    <div class="breadcrumb justify-content-center">
                                        <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                                            Actions
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                                            <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                                            <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection










