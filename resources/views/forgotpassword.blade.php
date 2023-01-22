@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4">
          <div class="row">
              <div class="col-md-4 offset-md-4">
                <h5 class="card-title text-center py-3"><strong>Reset password</strong></h5>
                  <div class="card">
                        <div class="card-body p-4">
                          <p class="text-muted text-center">Enter your email address and we’ll send you instructions to reset your password.</p>
                            <form action="{{route('check-password-email')}}" method="post">
                                @csrf
                              <div class="form-group pb-3">
                                  <label for="">Email</label>
                                  <input type="email" name="email" placeholder="Enter Email" class="form-control" required="">
                              </div>
                              <div class="form-group pb-3">
                                  <button class="btn appointment-btn m-0 w-100">Send Email</button>
                                  <a class="btn mt-2 btn-outline-dark br-30 m-0 w-100" href="{{ route('signin') }}">Cancel</a>
                              </div>
                            </form>
                        </div>
                  </div>
              </div>
          </div>
        </div>
    </section>

@endsection
