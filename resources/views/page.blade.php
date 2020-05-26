@extends('layout.app')

@section('content')
<div style="padding:15px 0">
        <div class="page-container">
            <div class="row justify-content-center" style="margin: 0;">

                <div class="col-12" >

                    <div class="row" style="">


                        <div class="col-md-auto d-none d-md-block text-right" style="direction:rtl;">
                                <newspaper-ver-ad
                                    :ad="{{$data['ad']['ver_ad']}}"
                                ></newspaper-ver-ad>
                        </div>

                        <div class="col-md-10 col-lg-9" style="">

                            <div class="row" >

                                <div class="col-lg-4 order-last order-lg-first" style="padding:0 20px" >

                                    <hor-ad
                                        :ad="{{$data['ad']['hor_ad']}}"
                                    ></hor-ad>

                                    <page-new-news
                                        :news="{{$data['new_news']}}"
                                    ></page-new-news>

                                    <page-sidebar-news
                                        :news="{{ json_encode($data['sidebar']['news']) }}"
                                        :more_news = "{{ json_encode($data['sidebar']['more_news']) }}"
                                    ></page-sidebar-news>

                                </div>
                                <div class="col-lg-8 order-first order-lg-last" style="padding:0 20px" >
                                    <div class="row justify-content-center" style="margin: 0; margin-top: 10px;">
                                        <div class="col-sm-12" style="padding:0">

                                            <div class="row" style="margin=0; ; border-radius:5px;box-shadow:0 0 4px #000000;">
                                                <div class="col-sm-12" style="padding:0">
                                                    <page-best-news
                                                        :news = "{{$data['best_news']}}"
                                                    ></page-best-news>
                                                </div>
                                            </div>

                                            <div class="row" style="margin=0;box-shadow:0 0 4px #000000; margin-top:10px ; border-radius:5px; background-color:#ffffff">
                                                <div class="col-sm-12" >
                                                        <div class="col-12 text-right" style="margin-top:5px;direction:rtl;color:#1b4b72;font-size:17px;">

                                                            <i class="fas fa-microphone"></i>
                                                            importent
                                                        </div>

                                                        <inline-news style="margin-top:5px"
                                                            :news = "{{$data['important_news']}}"
                                                        ></inline-news>


                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-1" >

                            <sidebar-best-journalist style="margin-top:10px"
                                :journalist = "{{$data['best_journalist']}}"
                            ></<sidebar-best-journalist>
                                
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
                <mobile-bottom-ad
                    :ad="{{$data['ad']['bottom_mobile_ad']}}"
                ></mobile-bottom-ad>
            </div>
    </footer>

@endsection
