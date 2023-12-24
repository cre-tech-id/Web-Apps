@extends('layout.base.base')

@section('content')
<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 align-self-center">
                    <div class="flash-error" data-flashdata="{{ session('success') }}"></div>
                        <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="1s">
                            @foreach($kesenian as $k)
                            <div class="title-kesenian mb-5" align="center">
                                <h1>{{$k->nama_kesenian}}</h1>
                            </div>
                            <img src="/storage/upload/kesenian/{{$k->foto}}" class="card-img-bottom"
                                style="width: 20%; height: 40%; float:left; margin-right: 10px; margin-bottom: 10px; margin-top:10px">
                            <p>{{$k->deskripsi}}</p>
                            <h5>Rp.{{$k->harga}}</h5>
                            @if(Session::get('isLoggedin')==true)
                            <button type="button" class="btn btn-primary btn-sm mt-2 open_modal" data-bs-toggle="modal"
                                value="{{$k->id}}" data-bs-target="#exampleModal">
                                @else
                                <a class="btn btn-primary btn-sm mt-2" href="{{route('login')}}">
                                    @endif
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-cart3" viewBox="0 0 16 16">
                                        <path
                                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                            </button>
                            @if(Session::get('isLoggedin')==true)
                            <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                                data-bs-target="#chatModal{{$k->id}}">
                                @else
                                <a class="btn btn-primary btn-sm mt-2" href="{{route('login')}}">
                                    @endif
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                                        <path
                                            d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path
                                            d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                    </svg>
                            </button>
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
<div class="modal fade" id="chatModal{{$k->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModal">Chat dengan seniman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <form name="chat" id="chat" method="post" action="{{route('store')}}">
                    @csrf
                    <input type="text" id="sender" name="sender" class="form-control" placeholder="Penyedia"
                        value="{{Session::get('id')}}" hidden>
                    <input type="text" id="receiver" name="receiver" class="form-control mt-3"
                        value="{{$k->seniman_id}}" hidden>
                    <input type="text" class="form-control mt-3" id="pesan" name="pesan" aria-label="message…"
                        placeholder="masukan pesan">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="" class="btn btn-primary">Kirim</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endforeach
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{route('tambahpemesanankesenian')}}" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control" id="id" aria-describedby="emailHelp"
                        placeholder="Enter email" name="kesenian_id" hidden>
                </div>
                <div class="mb-3">
                    <!-- <label for="exampleInputEmail1" class="form-label">Email address</label> -->
                    <input type="text" class="form-control" id="pemesan_id" aria-describedby="emailHelp"
                        name="pemesan_id" value="{{Session::get('id')}}" hidden>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi" aria-describedby="emailHelp"
                        name="lokasi">
                </div>
                <div class='mb-3'>
                  <label for="alamat" class="form-label">Tanggal Booking</label>
                  <input id="txtDate" name="tanggal" type="text" class="form-control date-input" required />
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Pesan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
