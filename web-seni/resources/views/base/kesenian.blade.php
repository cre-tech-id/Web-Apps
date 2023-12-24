@extends('layout.base.base')

@section('content')
<style>
    .card {
        transition: all 0.2s ease;
    }

    .card:hover {
        box-shadow: 5px 6px 6px 2px #e9ecef;
        transform: scale(1.1);
    }
    </style>
<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 align-self-center">
                        <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="1s">
                            <div class="row">
                            <div class="flash-data" data-flashdata="{{ session('success') }}"></div>
                            @foreach($kesenian as $k)
                            <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="/storage/upload/kesenian/{{$k->foto}}" class="card-img-bottom" height="250px">
                                            <a class="text-dark mt-2 stretched-link" href="detailkesenian/{{$k->id}}" style="font-size:15px">{{$k->nama_kesenian}}</a>
                                            <p>seni {{$k->kategori}}</p>
                                            <h5 class="card-title" style="font-size:15px">Rp.{{$k->harga}}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
