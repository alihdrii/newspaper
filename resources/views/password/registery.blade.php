@extends('layout.registeryApp')

@section('content')
<div style="padding:65px 0;">
    <div class="container">
            <div class="row justify-content-center" style="margin: 0;">

                <div class="col-12 col-md-6 col-lg-5 order-last order-md-first text-center" style="margin:25px 0">
                    <sign-in></sign-in>
                </div>
                <div class="col-12 col-md-6 col-lg-5 order-first order-md-last text-center " style="margin:25px 0" >
                    <sign-up></sign-up>
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
