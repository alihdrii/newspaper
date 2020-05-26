@extends('layout.app')

@section('content')
<div style="padding:15px 0">
    <div class="container">
            <div class="row justify-content-center" style="margin: 0;">

                <div class="col-12" style="">

                    <div class="row" style="">
                        <div class="col-md-auto d-none d-md-block text-right" style="direction:rtl;">
                            <newspaper-ver-ad></newspaper-ver-ad>
                        </div>
                        <div class="col-md-10" style="">
                            <div class="row" >

                                <div class="col-lg-4 order-last order-lg-first" style="padding:0 20px" >

                                    <hor-ad></hor-ad>

                                    <daily-tags
                                        style="margin-top:10px"
                                        :tag="{{$data['today_tag']}}"
                                    ></daily-tags>

                                    <poll style="margin-top:10px"></poll>

                                    <slidebar-news></slidebar-news>

                                    <daily-tags
                                        style="margin-top:10px"
                                        :tag="{{json_encode($data['popular_tag'])}}"
                                    ></daily-tags>

                                </div>
                                <div class="col-lg-8 order-first order-lg-last" style="padding:0 20px">

                                    <div class="row justify-content-center" style="margin: 0; margin-top: 10px;">
                                        <div class="col-sm-12" style="padding:0">

                                            <div class="row" style="border-radius:5px;box-shadow:0 0 4px #000000; background-color:#ffffff">
                                                <div class="col-sm-12">

                                                    <best-newspaper-news style="padding:10px 0"></best-newspaper-news>

                                                </div>
                                            </div>

                                            <div class="row" style="box-shadow:0 0 4px #000000; margin-top:10px ; border-radius:5px; background-color:#ffffff">
                                                <div class="col-sm-12">
                                                    <div class="col-12 text-right" style="margin-top:5px;direction:rtl;color:#1b4b72;font-size:17px;">

                                                            <i class="fas fa-microphone"></i>
                                                            سرخط خبرها
                                                    </div>
                                                    <inline-news-by-cat></inline-news-by-cat>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:10px;box-shadow:0 0 4px #000000; border-radius:5px; background-color:#ffffff">
                                                <div class="col-sm-12">
                                                    <newspaper-suggestion-news></newspaper-suggestion-news>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:10px;box-shadow:0 0 4px #000000; border-radius:5px; background-color:#ffffff">

                                                <div class="col-sm-12">
                                                    <inline-news></inline-news>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

    </div>
</div>
@endsection

@section('footer')

    <footer  style="background-color: #1b4b72;position:relative">
           <div style="padding:7px 0; color:#ffffff; font-size:12px">
                <div class="container text-center">
                    تمامی حقوق مادی و معنوی این وب اپلیکیشن متعلق به .... است
                </div>
           </div>
            <div class="fixed-bottom d-block d-sm-none">
                <mobile-bottom-ad
                    :ad="{{$data['ad']['bottom_mobile_ad']}}"
                ></mobile-bottom-ad>
            </div>
    </footer>

@endsection
