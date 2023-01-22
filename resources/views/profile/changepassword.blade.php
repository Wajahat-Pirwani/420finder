@extends('layouts.app')

@section('title', '420 Finder')

@section('content')

    <style>
        .spinner-border {
            width: 1rem;
            height: 1rem;
        }
    </style>

    <section class="mt-5 pt-5">
        <div class="container mt-4">
            <div class="row pt-5 customerLeftSidebar">
                <div class="col-md-3">
                    @include('partials/sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card p-3">
                        <h6>Change Password</h6>
                    </div>
                    <div class="card p-3 mt-3 shadow-sm">
                        <div class="row">
                            <form action="{{route('password.store')}}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <h6><strong>New Password</strong></h6>
                                    <input type="text" class="form-control" name="password"
                                           placeholder="Enter Your New Password">
                                    <br>
                                    <h6><strong>Confirm Password</strong></h6>
                                    <input type="text" class="form-control" name="confirm"
                                           placeholder="Enter Your Password Again">
                                    <br>
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
