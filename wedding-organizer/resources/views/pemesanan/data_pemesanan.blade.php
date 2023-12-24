@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data Pemesanan</h5>
                        </div>
                        <!-- <a href="{{ route('tambah_paket') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Data</a> -->
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Nama Pemesan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        No.Hp Pemesan
                                    </th>
                                    @if(Session::get('role')==1)
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                        Nama Penyedia
                                    </th>
                                    @endif
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Paket Dipesan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Tanggal Book
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Untuk tanggal
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Pembayaran
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemesanan as $p)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->nama_pemesan }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{$p->no_hp}}</p>
                                    </td>
                                    @if(Session::get('role')==1)
                                    <td class="ps-4">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->nama_penyedia }}</p>
                                    </td>
                                    @endif
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->nama_paket }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->created_at }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-l font-weight-bold mb-0">{{ $p->tanggal_book }}</p>
                                    </td>
                                    <td class="text-center">
                                        @if(Session::get('role')==2)
                                        @if($p->status == 'Belum dikonfirmasi')
                                        <a href="/pemesanan/terima/{{$p->id}}" class="btn btn-success btn-sm"
                                            data-bs-toggle="tooltip">
                                            Terima
                                        </a>
                                        <a href="/pemesanan/tolak/{{$p->id}}" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip">
                                            Tolak
                                        </a>
                                        @elseif($p->status == 'Diterima')
                                        <button type="button" disabled
                                            class="btn btn-outline-success btn-sm mt-3">Diterima</button>
                                        @else
                                        <button type="button" disabled
                                            class="btn btn-outline-danger btn-sm mt-3">Ditolak</button>
                                        @endif
                                        @else
                                        @if($p->status == 'Belum dikonfirmasi')
                                        <button type="button" disabled class="btn btn-outline-info btn-sm">Belum
                                            dikonfirmasi</button>
                                        @elseif($p->status == 'Diterima')
                                        <button type="button" disabled
                                            class="btn btn-outline-success btn-sm mt-3">Diterima</button>
                                        @else
                                        <button type="button" disabled
                                            class="btn btn-outline-danger btn-sm mt-3">Ditolak</button>
                                        @endif
                                    </td>
                                    @endif
                                    <td class="text-center">
                                        @if(Session::get('role')==2)
                                        <form method="POST" action="/pemesanan/pembayaran/{{$p->id}}" enctype="multipart/form-data">
                                        @csrf
                                            <select class="form-control dropdown" name="pembayaran" id="choices-button"
                                                placeholder="Departure" onchange='if(this.value != 0) { this.form.submit(); }'>
                                                <option value="" selected="">{{ $p->pembayaran }}</option>
                                                <option value="DP">DP</option>
                                                <option value="Lunas">Lunas</option>
                                            </select>
                                        </form>
                                        @else
                                        <p class="text-l font-weight-bold mb-0">{{ $p->pembayaran }}</p>
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
