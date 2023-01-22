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
                  <h6>Account Settings</h6>
                </div>

                <div class="card p-3 mt-3 shadow-sm">
                  <div class="row">
                    <div class="col-md-2">
                      <h6><strong>Profile Photo</strong></h6>
                      <div>
                        @if($user->profile == NULL)
                          <img src="{{ asset('dummy.png') }}" alt="profile" class="img-thumbnail text-center" style="border-radius: 50%;">
                        @else
                          <img src="{{ $user->profile }}" alt="profile" class="img-thumbnail text-center" style="border-radius: 50%;height: 125px;width: 125px;">
                        @endif
                      </div>
                    </div>
                    <div class="col-md-10 text-end">
                      <a data-bs-toggle="modal" data-bs-target="#profilepicture" class="cursor-pointer">Edit</a>
                    </div>
                  </div>
                </div>

                <div class="card p-3 mt-3 shadow-sm">
                  <div class="row">
                    <div class="col-md-6">
                      <h6><strong>Full Name</strong></h6>
                      <p class="text-black-50">{{ $user->name }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                      <a data-bs-toggle="modal" data-bs-target="#fullname" class="cursor-pointer">Edit</a>
                    </div>
                  </div>
                </div>

                <div class="card p-3 mt-3 shadow-sm bg-light">
                  <div class="row">
                    <div class="col-md-6">
                      <h6><strong>Email</strong></h6>
                      <p class="text-black-50">{{ $user->email }}</p>
                    </div>
                  </div>
                </div>

                <div class="card p-3 mt-3 shadow-sm">
                  <div class="row">
                    <div class="col-md-6">
                      <h6><strong>Phone Number</strong></h6>
                      <p class="text-black-50">{{ $user->phone }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                      <a data-bs-toggle="modal" data-bs-target="#phone_number" class="cursor-pointer">Edit</a>
                    </div>
                  </div>
                </div>

                <div class="card p-3 mt-3 shadow-sm">
                  <div class="row">
                    <div class="col-md-6">
                      <h6><strong>Date of Birth</strong></h6>
                      <p class="text-black-50">{{ $user->dateofbirth }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                      <a data-bs-toggle="modal" data-bs-target="#dateofbirth" class="cursor-pointer">Edit</a>
                    </div>
                  </div>
                </div>

                <div class="card p-3 mt-3 shadow-sm">
                  <div class="row">
                    <div class="col-md-6">
                      <h6><strong>Delivery Address</strong></h6>
                      <p class="text-black-50">{{ $user->delivery_address }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                      <a data-bs-toggle="modal" data-bs-target="#deliveryaddress" class="cursor-pointer">Edit</a>
                    </div>
                  </div>
                </div>

                <div class="card p-3 mt-3 shadow-sm">
                  <div class="row">
                    <div class="col-md-6">
                      <h6><strong>About</strong></h6>
                      <p class="text-black-50">{{ $user->about }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                      <a data-bs-toggle="modal" data-bs-target="#about" class="cursor-pointer">Edit</a>
                    </div>
                  </div>
                </div>

              </div>
          </div>

        </div>
    </section>


<!-- Profile Picture -->
<div class="modal fade" id="profilepicture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('saveprofilepicture') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <h6><strong>Update Profile Picture</strong></h6>
            </div>
            <div class="col-md-6 text-end pt-2 pe-3">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-md-12">
                <div class="form-group text-center">
                  @if($user->profile == NULL)
                    <img src="{{ asset('dummy.png') }}" style="border-radius: 50%;" class="img-thumbnail w-25 mb-5">
                  @else
                    <img src="{{ $user->profile }}" style="border-radius: 50%;width: 107px;height: 107px;" class="img-thumbnail w-25 mb-5">
                  @endif
                  <input type="file" name="profile" value="{{ $user->name }}" placeholder="Enter Full Name" class="form-control" required="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary w-100"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Full Name -->
<div class="modal fade" id="fullname" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <h6><strong>Edit Full Name</strong></h6>
          </div>
          <div class="col-md-6 text-end pt-2 pe-3">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-12">
              <div class="form-group">
                <label for="">Full Name</label>
                <input id="editname" type="text" name="name" value="{{ $user->name }}" placeholder="Enter Full Name" class="form-control" required="">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button id="savename" type="button" class="btn btn-primary w-100"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Phone -->
<div class="modal fade" id="phone_number" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <h6><strong>Edit Phone Number</strong></h6>
          </div>
          <div class="col-md-6 text-end pt-2 pe-3">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-12">
              <div class="form-group">
                <label for="">Phone Number</label>
                <input id="editphonenumber" type="number" name="name" value="{{ $user->phone }}" class="form-control" required="">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button id="savephonenumber" type="button" class="btn btn-primary w-100"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Date of birth -->
<div class="modal fade" id="dateofbirth" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <h6><strong>Edit Date of birth</strong></h6>
          </div>
          <div class="col-md-6 text-end pt-2 pe-3">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-12">
              <div class="form-group">
                <label for="">Date of birth</label>
                <input id="editdateofbirth" type="date" name="name" value="{{ $user->dateofbirth }}" class="form-control" required="">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button id="savedateofbirth" type="button" class="btn btn-primary w-100"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Delivery Address -->
<div class="modal fade" id="deliveryaddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <h6><strong>Edit Delivery Address</strong></h6>
          </div>
          <div class="col-md-6 text-end pt-2 pe-3">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-12">
              <div class="form-group">
                <label for="">Delivery Address</label>
                <input id="editdeliveryaddress" type="text" value="{{ $user->delivery_address }}" class="form-control" required="">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button id="savedeliveryaddress" type="button" class="btn btn-primary w-100"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- About -->
<div class="modal fade" id="about" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <h6><strong>Edit About</strong></h6>
          </div>
          <div class="col-md-6 text-end pt-2 pe-3">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-12">
              <div class="form-group">
                <label for="">About</label>
                <input id="editabout" type="text" value="{{ $user->about }}" class="form-control" required="">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button id="saveabout" type="button" class="btn btn-primary w-100"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span> Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
