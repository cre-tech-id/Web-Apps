@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Komentar</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="mt-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:15%;" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        User
                                    </th>
                                    <th style="width:15%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Paket
                                    </th>
                                    @if(Session::get('role')==1)
                                    <th style="width:15%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Penyedia
                                    </th>
                                    @endif
                                    <th style="width:20%;" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Komentar
                                    </th>
                                    @if(Session::get('role')==1)
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                    @endif
                                </tr>
                                <tr>
                                    <td><hr></td>
                                    <td><hr></td>
                                    <td><hr></td>
                                    @if(Session::get('role')==1)
                                    <td><hr></td>
                                    <td><hr></td>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($komentar as $k)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $k->nama_user }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $k->nama_paket }}</p>
                                    </td>
                                    @if(Session::get('role')==1)
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $k->nama_penyedia }}</p>
                                    </td>
                                    @endif
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $k->komentar }}</p>
                                    </td>
                                    @if(Session::get('role')==1)
                                    <td class="text-center">
                                        <span>
                                        <a href="/komentar/hapus/{{ $k->id }}" class="" data-bs-toggle="tooltip" >
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
                                    @if(Session::get('role')==1)
                                    <td><hr></td>
                                    <td><hr></td>
                                    @endif
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
