@extends('layouts.app')

@section('title', '420 Finder')

@section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <h5 class="card-title text-center py-3"><strong>Reset Password</strong></h5>
                    <div class="card">
                        <div class="card-body p-4">
                            <form action="{{route('update-password')}}" method="post">
                                @csrf
                                <div class="form-group pb-3">
                                    <label for="">Password</label>
                                    <input type="password" name="password" placeholder="Password" class="form-control" required="">
                                </div>
                                <div class="form-group pb-3">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required="">
                                </div>
                                <input type="hidden" name="user_id" value="{{$id}}" />
                                <div class="form-group pb-3">
                                    <button class="btn appointment-btn m-0 w-100">Reset Password </button>
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
