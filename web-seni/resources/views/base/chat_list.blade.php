@extends('layout.base.base')

@section('content')
<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 align-self-center">
                        <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="1s">
                            <div class="row">
                                <div class="col-lg-12">
                                    @foreach($chat as $k)
                                    @if($k->sender == Session::get('nama'))
                                    <div class="card mb-5">
                                        <div class="card-body">
                                        <a class="text-dark mt-2 stretched-link" href="/chat/{{$k->reciever_id}}" style="font-size:15px"></a>
                                            <h5 class="card-title">{{$k->reciever}}</h5>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th>{{$k->pesan}}</th>
                                                    <tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @elseif($k->sender != Session::get('nama'))
                                    <div class="card mb-5">
                                        <div class="card-body">
                                        <a class="text-dark mt-2 stretched-link" href="/chat/{{$k->sender_id}}" style="font-size:15px"></a>
                                            <h5 class="card-title">{{$k->sender}}</h5>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th>{{$k->pesan}}</th>
                                                    <tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif    
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                            <!-- <img src="assets/images/slider-dec.png" alt=""> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
