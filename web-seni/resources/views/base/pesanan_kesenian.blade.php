@extends('layout.base.base')

@section('content')
<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 align-self-center">
                        <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="1s">
                            <div class="row">
                                <div class="flash-data" data-flashdata="{{ session('success') }}"></div>
                                @foreach($kesenian as $k)
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$k->nama_kesenian}}</h5>
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th>Lokasi</th>
                                                    <td>{{$k->lokasi}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Booking</th>
                                                    <td>{{$k->tanggal_book}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    @if($k->status == '-')
                                                    <td>Belum Dikonfirmasi</td>
                                                    @else
                                                    <td>{{$k->status}}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th>Pembayaran</th>
                                                    @if($k->pembayaran == '-')
                                                    <td>Belum dibayar</td>
                                                    @else
                                                    <td>{{$k->pembayaran}}</td>                                                    
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="#" class="btn btn-primary">Pesanan diterima</a>
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
