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
                                <div class="flash-data" data-flashdata="{{ session('success') }}"></div>
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col">
                                            <div class="card-body">
                                                @foreach($users as $s)
                                                <br>
                                                <center>
                                                <img src="/storage/upload/profile/{{$s->foto}}" style="width: 200px;"/>
                                                    <h5 class="mt-3">{{$s->nama}}</h5>
                                                    <br>
                                                </center>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Tempat, tanggal lahir</label>
                                                    <input type="text" class="form-control" value="{{$s->ttl}}"
                                                        disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" value="{{$s->alamat}}"
                                                        disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Email</label>
                                                    <input type="text" class="form-control" value="{{$s->email}}"
                                                        disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Agama</label>
                                                    <input type="text" class="form-control" value="{{$s->agama}}"
                                                        disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nomor Hp</label>
                                                    <input type="text" class="form-control" value="{{$s->no_hp}}"
                                                        disabled>
                                                </div>
                                                <a href="/edituserprofile/{{ $s->id }}"
                                                    class="btn btn-primary btn-sm mt-3">Edit</a>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
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
