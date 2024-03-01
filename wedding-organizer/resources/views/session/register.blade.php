@extends('layouts.user_type.guest')

@section('content')

<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg"
        style="background-image: url('../assets/img/logins.png');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Silahkan Daftarkan Akun Anda</h1>
                    <!-- <p class="text-lead text-white">Use these awesome forms to login or create new account in your
                        project for free.</p> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">

                    <div class="card-body">
                        <form role="form text-left" method="POST" action="/register" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="gambar">Nama</label>
                                <input type="text" class="form-control" placeholder="Nama" name="nama" id="nama"
                                    aria-label="Name" aria-describedby="username" value="{{ old('nama') }}">
                                @error('nama')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gambar">Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                    aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                                @error('email')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gambar">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password"
                                    id="password" aria-label="Password" aria-describedby="password-addon">
                                @error('password')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gambar">Alamat</label>
                                {!! Form::select('kota', $kota, '$kota', [
                                'class' => 'form-control',
                                'placeholder' => 'Pilih Kota',
                                'id' => 'kota_id'
                                ]) !!}
                                <div class="" id="kec"></div>
                                <div class="" id="desa"></div>
                                <br>
                                <input type="text" class="form-control" placeholder="Masukan Detail Alamat" name="jl" id="jl">
                                @error('alamat')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gambar">No Hp</label>
                                <input type="text" class="form-control" placeholder="No Hp" name="no_hp" id="no" value="{{ old('no_hp') }}">
                                @error('no_hp')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="desc">Deskripsi</label><br>
                                {{-- <input type="text" class="form-control" placeholder="No Hp" name="desc" id="desc" value="{{ old('desc') }}"> --}}
                                <textarea name="desc" id="desc" cols="31" rows="10" value="{{ old('desc') }}"></textarea>
                                @error('desc')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3" hidden>
                                <input type="text" class="form-control" value="2" name="role_id" id="role_id">
                            </div>
                            <div>
                                <label for="gambar">Foto Profil</label>
                                <input class="form-control" type="file" id="gambar" name="gambar">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Already have an account? <a href="login"
                                    class="text-dark font-weight-bolder">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
        $(document).ready(function() {
            $('body').on('change', '#kota_id', function() {
                let id = $(this).val();
                let route = "{{ $route_get_kecamatan }}";
                $.ajax({
                    type: 'get',
                    url: route,
                    data: {
                        kota_id: id
                    },
                    success: function(data) {
                        $('#kec').html(data);
                    }
                })
            })
        })

        $('body').on('change', '#kecamatan_id', function() {
                let id = $(this).val();
                let route = "{{ $route_get_desa }}";
                $.ajax({
                    type: 'get',
                    url: route,
                    data: {
                        kecamatan_id: id
                    },
                    success: function(data) {
                        $('#desa').html(data);
                    }
                })
            })
        
    </script>
@endsection
