@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4">
          <div class="row">
              <div class="col-md-4 offset-md-4">
                <h5 class="card-title text-center py-3"><strong>Sign up</strong></h5>
                  <div class="card">
                        <div class="card-body">
                            <form action="{{ route('accountsignup') }}" method="POST">
                              @csrf
                              <div class="form-group pb-3">
                                  <label for="">Full Name</label>
                                  <input type="text" name="name" placeholder="Enter Full Name" class="form-control" required="" value="{{ old('name') }}">
                              </div>
                              <div class="form-group pb-3">
                                  <label for="">Email</label>
                                  <input type="email" name="email" placeholder="Enter Email" class="form-control" required="" value="{{ old('email') }}">
                              </div>
                              <div class="form-group pb-3">
                                  <label for="">Password</label>
                                  <input type="password" name="password" placeholder="Enter Password" class="form-control" required="">
                              </div>

                              <div class="form-group pb-3">
                                <label for="">Confirm Password</label>
                                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required="">
                            </div>

                              <div class="form-group pb-3">
                                  <button class="btn appointment-btn m-0 w-100">Sign Up</button>
                              </div>
                              <div class="form-group text-center">
                                  <a href="{{ route('signin') }}">Already have an account. Sign in</a>
                              </div>
                            </form>
                        </div>
                  </div>
              </div>
          </div>
        </div>
    </section>

@endsection
