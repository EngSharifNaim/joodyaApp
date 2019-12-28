@extends("app")

@section('head_title', getcong_widgets('about_title') .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

    <section id="content">
        <div class="container">
            <div class="shop-banner banner-adv line-scale zoom-image">
                <a href="#" class="adv-thumb-link"><img src="images/page/about.jpg" alt=""></a>
                <div class="banner-info">
{{--                    <h2 class="title30 color">About</h2>--}}
{{--                    <div class="bread-crumb white"><a href="#" class="white">Home</a><span>About Us</span></div>--}}
                </div>
            </div>
            <!-- ENd Banner -->
            <div class="content-page">
                <div class="fruit-health health-about">
                    <h2 class="title30 font-bold title-box1 text-center">{{$widgets->about_title}}</h2>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="list-diet custom-scroll mCustomScrollbar _mCS_1"><div class="mCustomScrollBox mCS-light" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;"><div class="mCSB_container" style="position:relative; top:0;">
                                        <div class="item-diet table">
                                            <div class="diet-thumb"><a href="#"><img src="nsite_assets/images/home/home1/diet1.png" alt=""></a></div>
                                            <div class="diet-info">
                                                <h3 class="title18"><a href="#" class="black">{{$widgets->footer_widget1_title}}</a></h3>
                                                <p class="desc">{{$widgets->footer_widget1_desc}}</p>
                                            </div>
                                        </div>
                                        <div class="item-diet table">
                                            <div class="diet-thumb"><a href="#"><img src="nsite_assets/images/home/home1/diet1.png" alt=""></a></div>
                                            <div class="diet-info">
                                                <h3 class="title18"><a href="#" class="black">{{$widgets->footer_widget2_title}}</a></h3>
                                                <p class="desc">{{$widgets->footer_widget2_desc}}</p>
                                            </div>
                                        </div>
                                        <div class="item-diet table">
                                            <div class="diet-thumb"><a href="#"><img src="nsite_assets/images/home/home1/diet1.png" alt=""></a></div>
                                            <div class="diet-info">
                                                <h3 class="title18"><a href="#" class="black">{{$widgets->footer_widget3_title}}</a></h3>
                                                <p class="desc">{{$widgets->footer_widget3_address}}</p>
                                            </div>
                                        </div>

                                    </div><div class="mCSB_scrollTools" style="position: absolute; display: block;"><a class="mCSB_buttonUp" oncontextmenu="return false;"></a><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; height: 117px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position: relative; line-height: 117px;"></div></div><div class="mCSB_draggerRail"></div></div><a class="mCSB_buttonDown" oncontextmenu="return false;"></a></div></div></div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="diet-image"><img src="{{url('nsite_assets\images\home\home1\ruler.jpg')}}" alt=""></div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="diet-intro">
                                <p class="desc">{{$widgets->about_desc}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Fruit Health -->
            </div>
            <!-- End Content Page -->
        </div>
        <div class="what-about">
            <div class="container">
                <h2 class="title30 text-center font-bold">قالوا عن جوديا</h2>
                <div class="about-client-slider">
                    <div class="wrap-item owl-carousel owl-theme" data-itemscustom="[[0,1]]" data-transition="fade" style="opacity: 1; display: block;">
                        <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 4980px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px);"><div class="owl-item active first-item last-item" style="width: 830px;"><div class="item-about-client text-center">
                                        <div class="client-thumb">
                                            <a href="#"><img src="images/page/cl1.jpg" alt=""></a>
                                        </div>
                                        <p class="desc">“Mauris id ipsum et magna egestas volutpat in ac neque. Phasellus sit amet risus sit amet elit ultrices rutrum. Proin vel gravida risus, mollis egestas velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.”</p>
                                        <h3 class="title18 font-bold"><a href="#" class="black">Jammie Stone</a></h3>
                                        <span class="color">Our happy customer</span>
                                    </div></div><div class="owl-item" style="width: 830px;"><div class="item-about-client text-center">
                                        <div class="client-thumb">
                                            <a href="#"><img src="images/page/cl2.jpg" alt=""></a>
                                        </div>
                                        <p class="desc">“Mauris id ipsum et magna egestas volutpat in ac neque. Phasellus sit amet risus sit amet elit ultrices rutrum. Proin vel gravida risus, mollis egestas velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.”</p>
                                        <h3 class="title18 font-bold"><a href="#" class="black">Jesus Navas</a></h3>
                                        <span class="color">Our happy customer</span>
                                    </div></div><div class="owl-item" style="width: 830px;"><div class="item-about-client text-center">
                                        <div class="client-thumb">
                                            <a href="#"><img src="images/page/cl3.jpg" alt=""></a>
                                        </div>
                                        <p class="desc">“Mauris id ipsum et magna egestas volutpat in ac neque. Phasellus sit amet risus sit amet elit ultrices rutrum. Proin vel gravida risus, mollis egestas velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.”</p>
                                        <h3 class="title18 font-bold"><a href="#" class="black">Kevil Bruyn</a></h3>
                                        <span class="color">Our happy customer</span>
                                    </div></div></div></div>


                        <div class="owl-controls clickable" style="display: block;"><div class="owl-pagination"><div class="owl-page active"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div></div></div>
                </div>
            </div>
        </div>
        <!-- End What About -->
    </section>
 

@endsection
