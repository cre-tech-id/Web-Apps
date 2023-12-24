@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Edit Data') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                @foreach($user as $u)
                <form role="form text-left" method="POST" action="{{ route('post_edit_user') }}">
                    @csrf
                    <input type="text" class="form-control" name="id" id="id" value="{{ $u->id }}" hidden>
                    <div class="mb-3">
                        <label for="username">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama" name="nama" id="username" aria-label="Name" aria-describedby="name" value="{{ $u->nama }}">
                        @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ $u->email }}">
                        @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat" id="alamat" aria-label="alamat" aria-describedby="name" value="{{ $u->alamat }}">
                        @error('alamat')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp">No Hp</label>
                        <input type="text" class="form-control" name="no_hp" id="username" value="{{ $u->no_hp }}">
                        @error('no_hp')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Role</label>
                            <select class="form-control" name="role" id="exampleFormControlSelect2" style="-webkit-appearance: listbox !important;">
                            <option value="{{$u->idRole}}">{{$u->role}}</option>
                                @foreach($role as $r)
                                <option value="{{$r->id}}">{{$r->role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection