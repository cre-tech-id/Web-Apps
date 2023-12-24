@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data Event</h5>
                        </div>
                        @if(Session::get('role')==2)
                        <a href="{{ route('tambah_event') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Data</a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="mt-4" style="width:100%">
                            <thead>
                                <tr>
                                @if(Session::get('role')==1)
                                    <th style="width:10%;" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Penyedia
                                    </th>
                                @endif    
                                    <th style="width:15%;" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Nama Event
                                    </th>
                                    <th style="width:15%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Tanggal
                                    </th>
                                    <th style="width:20%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Lokasi
                                    </th>
                                    <th style="width:40%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Deskripsi
                                    </th>
                                    @if(Session::get('role')==2)
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                    @endif
                                </tr>
                                <tr>
                                    <td><hr></td>
                                    <td><hr></td>
                                    <td><hr></td>
                                    <td><hr></td>
                                    <td><hr></td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($event as $p)
                                <tr>
                                @if(Session::get('role')==1)
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->nama }}</p>
                                    </td>
                                @endif    
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->nama_event }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->tanggal }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->lokasi }}</p>
                                    </td>
                                    <td class="text-center">
                                        {{ $p->deskripsi }}
                                    </td>
                                    @if(Session::get('role')==2)
                                    <td class="text-center">
                                        <a href="/event/edit/{{$p->id}}" class="mx-3" data-bs-toggle="tooltip" >
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                        <a href="/event/hapus/{{ $p->id }}" class="" data-bs-toggle="tooltip" >
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </a>
                                        </span>
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><hr></td>
                                    <td><hr></td>
                                    <td><hr></td>
                                    <td><hr></td>
                                    <td><hr></td>
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