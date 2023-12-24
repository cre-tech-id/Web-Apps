@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data Penyedia</h5>
                        </div>
                        @if(Session::get('role')=='2')
                        <a href="{{ route('tambah_penyedia') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Foto
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Nama Penyedia
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Deskripsi Penyedia
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Alamat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No Hp
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Konfirmasi Penyedia
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($penyedia as $p)
                                <tr>
                                    <td class="ps-4">
                                        <img src="/storage/upload/profile/{{ $p->gambar }}" width="100" height="100">
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->nama }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->desc }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->alamat }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->no_hp }}</p>
                                    </td>
                                    <td class="text-center">
                                        @if($p->is_verify==0)
                                        <a href="/penyedia/terima/{{$p->id}}" class="btn btn-success btn-sm"
                                            data-bs-toggle="tooltip">
                                            Terima
                                        </a>
                                        <a href="/penyedia/tolak/{{$p->id}}" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip">
                                            Tolak
                                        </a>
                                        @elseif($p->is_verify==1)
                                        <button type="button" disabled
                                            class="btn btn-outline-success btn-sm mt-3">Diterima</button>
                                        @elseif($p->is_verify==2)
                                        <button type="button" disabled
                                            class="btn btn-outline-danger btn-sm mt-3">Ditolak</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(Session::get('role')=='1')
                                        <a href="/penyedia/hapus/{{ $p->id }}" class="" data-bs-toggle="tooltip" data-bs-original-title="Delete user">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </a>
                                        <span>
                                        @else
                                        <a href="/penyedia/edit/{{$p->id}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a href="/penyedia/hapus/{{ $p->id }}" class="" data-bs-toggle="tooltip" data-bs-original-title="Delete user">
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
