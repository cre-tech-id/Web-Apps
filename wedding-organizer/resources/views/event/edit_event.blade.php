@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Edit Data') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                @foreach($event as $e)
                <form role="form text-left" method="POST" action="{{ route('post_edit_event') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" placeholder="Nama Event" name="id" value="{{$e->id}}" hidden>
                    <div class="mb-3">
                    <label for="gedung">Nama Event</label>
                        <input type="text" class="form-control" placeholder="Nama Event" name="nama_event" value="{{$e->nama_event}}">
                    </div>
                    <div class="mb-3">
                        <div class="form-group" hidden>
                            <label for="exampleFormControlSelect2">Penyedia</label>
                            <input type="text" class="form-control" placeholder="Penyedia" name="penyedia_id" value="{{Session::get('id')}}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group" >
                            <label for="exampleFormControlSelect2">Tanggal</label>
                            <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" value="{{$e->tanggal}}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group" >
                            <label for="exampleFormControlSelect2">Lokasi</label>
                            <input type="text" class="form-control" placeholder="Lokasi" name="lokasi" value="{{$e->lokasi}}">
                        </div>
                    </div>
                    <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="lokasi" rows="3" name="deskripsi">{{$e->deskripsi}}</textarea>
                    </div>
                    <label for="gambar">Gambar</label>
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