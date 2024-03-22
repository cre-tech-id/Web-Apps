@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data Paket</h5>
                        </div>
                        @if(Session::get('role')==2)
                        <a href="{{ route('tambah_paket') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Data</a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="mt-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:15%;" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Nama Paket
                                    </th>
                                    <th style="width:50%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Detail
                                    </th>
                                    <th style="width:15%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Harga
                                    </th>
                                    <th style="width:10%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th style="width:20%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paket as $p)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->nama_paket }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->detail }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">Rp. {{ $p->harga }}</p>
                                    </td>
                                    <td class="text-center">
                                        @if(Session::get('role')==2)
                                        <form method="POST" action="/paket/status/{{$p->id}}" enctype="multipart/form-data">
                                            @csrf
                                            <select class="form-control dropdown" name="status" id="choices-button" placeholder="Departure" onchange='if(this.value != 0) { this.form.submit(); }'>
                                                <option value="" selected="">{{ $p->status }}</option>
                                                @if($p->status == 'Open')
                                                <option value="Close">Close</option>
                                                @else
                                                <option value="Open">Open</option>
                                                @endif
                                            </select>
                                        </form>
                                        @else
                                        <p class="text-l font-weight-bold mb-0">{{ $p->status }}</p>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(Session::get('role')==1)
                                        <a href="/paket/hapus/{{ $p->id }}" class="" data-bs-toggle="tooltip">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </a>
                                        @else
                                        <a href="/paket/edit/{{$p->id}}" class="mx-3" data-bs-toggle="tooltip">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <a href="/paket/hapus/{{ $p->id }}" class="" data-bs-toggle="tooltip">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </a>
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
