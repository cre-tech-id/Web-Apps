@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Edit Data') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                @foreach($admin as $a)
                <form role="form text-left" method="POST" action="{{ route('post_edit_admin') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" name="id" id="id" value="{{ $a->id }}" hidden>
                    <div class="mb-3">
                        <label for="username">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama" name="username" id="username" aria-label="Name" aria-describedby="name" value="{{ $a->nama }}">
                        @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ $a->email }}">
                        @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp">Nomor Hp</label>
                        <input type="text" class="form-control" placeholder="Nomor Hp" name="no_hp" id="no_hp" aria-label="Email" aria-describedby="email-addon" value="{{ $a->no_hp }}">
                        @error('no_hp')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3" hidden>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Role</label>
                            <select class="form-control" name="role" id="exampleFormControlSelect2" style="-webkit-appearance: listbox !important;">
                                <option value="{{$a->idRole}}">{{$a->role}}</option>
                                @foreach($role as $r)
                                <option value="{{$r->id}}">{{$r->role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="gambar">Foto Profil</label>
                        <input class="form-control" type="file" id="gambar" name="gambar">
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
