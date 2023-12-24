@extends('layout.dashboard.dashboard')
@section('content')
<div class="layout-page">
    <!-- Navbar -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <h3 style="margin-top:15px">Tambah Karya</h3>
                </div>
            </div>
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar">
                            @foreach($users as $s)
                            <img src="/storage/upload/profile/{{$s->foto}}" alt class="w-px-40 h-auto rounded-circle" />
                            @endforeach
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                            @foreach($users as $s)
                            <img src="/storage/upload/profile/{{$s->foto}}" alt class="w-px-40 h-auto rounded-circle" />
                            @endforeach
                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{Session::get('nama')}}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('profile')}}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <li>
                            @foreach($users as $s)
                            <a class="dropdown-item" href="/editprofile/{{ $s->id }}">
                            @endforeach
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Edit Profile</span>
                            </a>
                        </li>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('logout')}}">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
                    </div>
                </nav>
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class=" content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-12 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col">
                                            <div class="card-body">
                                                <form method="POST" enctype="multipart/form-data"
                                                    action="{{route('dotambahkarya')}}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama Karya</label>
                                                        <input type="text" class="form-control" id="nama_karya" name="nama_karya">
                                                    </div>
                                                    @if(Session::get('role')=='1')
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Seniman</label>
                                                        <select class="form-select" name="id_seniman">
                                                            @foreach($seniman as $a)
                                                            <option value="{{$a->id}}">{{$a->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @else
                                                    <input type="text" name="id_seniman" value="{{Session::get('id')}}" hidden>
                                                    @endif
                                                    <div class="mb-3">
                                                        <label for="alamat" class="form-label">Deskripsi</label>
                                                        <input type="text" class="form-control" id="deskripsi"
                                                            name="deskripsi">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kategori">Kategori</label>
                                                        <select class="form-select" name="kategori" id="kategori">
                                                            <option selected>Pilih Kategori!</option>
                                                            <option value="musik">Seni Musik</option>
                                                            <option value="rupa">Seni Rupa</option>
                                                            <option value="sastra">Seni Sastra</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="no" class="form-label">Harga</label>
                                                        <input type="text" class="form-control" id="harga" name="harga">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="stok" class="form-label">Stok</label>
                                                        <input type="number" class="form-control" id="stok" name="stok">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="no" class="form-label">Foto</label>
                                                        <input type="file" accept="image/*" class="form-control" id="foto" name="foto"
                                                            required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endsection
