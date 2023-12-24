@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Edit Data') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
            @foreach($paket as $g)
                <form role="form text-left" method="POST" action="{{ route('post_edit_paket') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $g->id }}">
                    <div class="mb-3">
                    <label for="gedung">Nama Paket</label>
                        <input type="text" class="form-control" name="nama_paket" id="nama_gedung" value="{{ $g->nama_paket }}">
                    </div>
                    @if(Session::get('role')==1)
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Penyedia</label>
                            <select class="form-control" name="penyedia_id" id="exampleFormControlSelect2" style="-webkit-appearance: listbox !important;">
                                <option value="{{$g->penyedia_id}}">{{$g->nama}}</option>
                                @foreach($penyedia as $pe)
                                <option value="{{$pe->id}}">{{$pe->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                    <div class="mb-3">
                        <div class="form-group" hidden>
                            <label for="exampleFormControlSelect2">Penyedia</label>
                            <input type="text" class="form-control" placeholder="Penyedia" name="penyedia_id" value="{{Session::get('id')}}">
                        </div>
                    </div>
                    @endif
                    <div class="mb-3">
                    <label for="detail">Detail</label>
                        <textarea class="form-control" id="detail" rows="3" placeholder="Masukan Detail" name="detail">{{ $g->detail }}</textarea>
                    </div>
                    <div class="mb-3">
                    <label for="harga">Harga</label>
                        <input type="text" class="form-control" placeholder="Harga" name="harga" id="harga" aria-label="harga" aria-describedby="harga" value="{{ $g->harga }}">
                    </div>
                    <div class="mb-3">
                    <label for="harga">Minimal DP</label>
                        <input type="text" class="form-control" placeholder="Minimal DP" name="min_dp" id="min_dp" aria-label="harga" aria-describedby="harga" value="{{ $g->min_dp }}">
                    </div>
                    <div class="mb-3">
                    <label for="gambar">Gambar</label>
                        <input class="form-control" type="file" id="gambar" name="gambar">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                    @endforeach
                </form>

            </div>
        </div>
    </div>
</div>
@endsection