@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    @if(!empty(session('business_id')))
      <script>
          window.location.href = "{{route('businessprofile')}}";
      </script>
    @endif

    <section class="mt-5 pt-5">
        <div class="container mt-4">
          <div class="row">
              <div class="col-md-4 offset-md-4">
                <h5 class="card-title text-center pt-3"><strong>Welcome back</strong></h5>
                <p class="text-center">Sign In to your business account</p>
                  <div class="card">
                    <div class="card-body p-4">
                      <form action="{{ route('authenticate') }}" method="POST">
                        @csrf
                        <div class="form-group pb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" placeholder="Enter Email" class="form-control" required="" value="{{ old('email') }}">
                        </div>
                        <div class="form-group pb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" placeholder="Enter Password" class="form-control" required="">
                        </div>
                        <div class="form-group pb-3">
                          <div class="row">
                            <div class="col-md-6 col-6">
                              <label for="">
                                <input type="checkbox" name="rememberme">
                                Remember me
                              </label>
                            </div>
                            <div class="col-md-6 col-6 text-end">
                              <a href="{{ route('forgotpassword') }}">Forgot your password!</a>
                            </div>
                          </div>
                        </div>
                        <div class="form-group pb-3">
                            <button class="btn appointment-btn m-0 w-100">Sign In</button>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('addabusiness') }}">Don't have an account. Sign up</a>
                        </div>
                      </form>
                    </div>
                  </div>
              </div>
          </div>
        </div>
    </section>

@endsection
