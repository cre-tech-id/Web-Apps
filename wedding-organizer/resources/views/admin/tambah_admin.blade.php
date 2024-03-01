@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Tambah Data') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form role="form text-left" method="POST" action="{{ route('post_admin') }}" enctype="multipart/form-data">
                    @csrf
                    <input type=" text" class="form-control" name="role" id="role" value="1" hidden>
                    <div class="mb-3">
                        <label for="username">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama" name="nama_admin" id="nama_admin"
                            aria-label="Name" aria-describedby="name">
                        @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                            aria-label="Email" aria-describedby="email-addon">
                        @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password"
                            aria-label="Password" aria-describedby="password-addon">
                        @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                   
                    <div class="mb-3">
                        <label for="no_hp">Nomor Hp</label>
                        <input type="text" class="form-control" placeholder="Nomor Hp" name="no_hp" id="no_hp"
                            aria-label="Email" aria-describedby="email-addon">
                        @error('no_hp')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="gambar">Foto Profil</label>
                        <input class="form-control" type="file" id="gambar" name="gambar" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
