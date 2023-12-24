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
                                @foreach($users as $a)
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{route('doedituserprofile')}}">
                                    @csrf
                                    <input type="text" class="form-control" name="id" id="id" value="{{ $a->id }}"
                                        hidden>
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $a->nama }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ $a->email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Tempat, Tanggal Lahir</label>
                                        <input type="text" class="form-control" id="ttl" name="ttl"
                                            value="{{ $a->ttl }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Agama</label>
                                        <input type="text" class="form-control" id="agama" name="agama"
                                            value="{{ $a->agama }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            value="{{ $a->alamat }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="no" class="form-label">Nomor Hp</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                                            value="{{ $a->no_hp }}">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="role" name="role"
                                            value="{{ $a->role_id }}" hidden>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no" class="form-label">Foto</label>
                                        <input type="file" accept="image/*" class="form-control" id="foto" name="foto">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
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
