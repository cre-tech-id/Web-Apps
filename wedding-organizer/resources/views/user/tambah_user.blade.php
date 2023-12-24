@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Tambah Data') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form role="form text-left" method="POST" action="{{ route('post_user') }}">
                    @csrf
                    <input type="text" class="form-control" name="role" id="role" value="3" hidden>
                    <div class="mb-3">
                    <label for="username">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama" name="nama" id="nama">
                        @error('username')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                    <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon">
                        @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                    <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                        @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                    <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat" id="alamat" aria-label="alamat">
                        @error('alamat')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">  
                    <label for="no_hp">Nomor Hp</label>
                        <input type="text" class="form-control" placeholder="No Hp" name="no_hp" id="password" aria-label="Password" aria-describedby="password-addon">
                        @error('no_hp')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
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