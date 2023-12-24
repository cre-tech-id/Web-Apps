@extends('layouts.user_type.guest')

@section('content')
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
          {{-- <div class="bgimg">
              <img src="/assets/img/logins.png" width="100" height="100">
            </div> --}}
            <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <br>
              <div class="container mt-4"><br>
                <h3 class="font-weight-bolder" style="color: #ff69f4; text-emphasis-color: inherit">Selamat Datang di Wedding Organizer</h3>
              </div>
              <div class="card card mt-4">
                <div class="flash-data" data-flashdata="{{ session('success') }}"></div>
                <div class="flash-info" data-flashdata="{{ session('message') }}"></div>
                <div class="card-body">
                  <form role="form" method="POST" action="/session">
                    @csrf
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" name="email" id="username" placeholder="Email">
                      @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn w-100 mt-4 mb-0" style="color: #ff69f4; text-emphasis-color: inherit">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="register" class=" font-weight-bold" style="color: #ff69f4; text-emphasis-color: inherit">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mt-9">
                <img src="/assets/img/we.svg" >
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
