@extends('layout.app')

@section('content')
<div style="padding:15px 0;">
    <div class="container">
            <div class="row justify-content-center" style="margin: 0;">

                <div class="col-12" style="">

                    <div class="row justify-content-center">

                        <div class="col-md-10" >
                            <div class="row" >

                                <div class="col-lg-4 order-last order-lg-first" style="padding:0 20px" >

                                    <news-hor-ad></news-hor-ad>

{{--                                    <daily-tags--}}
{{--                                        style="margin-top:10px"--}}
{{--                                        :tag="{{$data['today_tag']}}"--}}
{{--                                    ></daily-tags>--}}

                                    <news-slidebar-news></news-slidebar-news>

{{--                                    <daily-tags--}}
{{--                                        style="margin-top:10px"--}}
{{--                                        :tag="{{json_encode($data['popular_tag'])}}"--}}
{{--                                    ></daily-tags>--}}

                                </div>
                                <div class="col-lg-8 order-first order-lg-last" style="padding:0 20px">

                                    <div class="row justify-content-center" style="margin-top: 10px;">
                                        <div class="col-sm-12" style="padding:0">
                                            <div class="row" style="margin:0 ; border-radius:5px;box-shadow:0 0 4px #000000; background-color:#ffffff">
                                                <div class="col-sm-12">
                                                    <news
{{--                                                        :report = "{{$data['reportItems']}}"--}}
                                                        :id = "{{$data['id']}} "
{{--                                                        :save = "{{json_encode($data['savedNews'])}}"--}}
                                                    ></news>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-auto d-none d-md-block text-right order-first order-lg-last" style="direction:rtl;padding:0 5px">
                            <news-ver-ad></news-ver-ad>
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
                    @copyright..2019
                </div>
           </div>
            <div class="fixed-bottom d-block d-sm-none">
{{--                <mobile-bottom-ad--}}
{{--                    :ad="{{$data['ad']['bottom_mobile_ad']}}"--}}
{{--                ></mobile-bottom-ad>--}}
            </div>
    </footer>


@endsection
