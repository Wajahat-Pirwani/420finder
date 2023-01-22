@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5 b-submit-bg mdn">
        <div class="container mt-4">
          <div class="row py-4">
              <div class="col-md-6 offset-md-3 border p-5 bt-white">
                <h5 class="card-title text-center bg-light pb-3 shadow-sm">
                  <img src="{{ asset('images/web/BOX ICON 2.png') }}" alt="420 Finder Logo" class="w-25">
                </h5>
                <div class="mt-4">
                  <h1 class="pb-3 text-center t-color t-italic"><strong>BUSINESS SUBMITTED</strong></h1>
                    <h4 class="text-center t-gray t-italic mb-2" style="font-size: 1.47rem;">Congratulations, your business account is now active you can access your business dashboard <a href="{{route('profile')}}" class="t-color t-under"><strong>here</strong></a> </h4>
                    <p class="text-center t-italic t-gray m-0">NOTICE</p>
                    <p class="text-center t-italic t-gray m-0">The business you recently submited is still pending final admin approval.</p>
                    <p class="text-center t-italic t-gray m-0">you will be notified whenever you have been approved.</p>
                    <h5 class="card-title text-center bg-light pt-4 shadow-sm m-0">
                        <img src="{{ asset('images/web/420FINDERBIZ LOGO.png') }}" alt="420 Finder Logo" class="w-25">
                    </h5>
                </div>
              </div>
          </div>
        </div>
    </section>
    <section class="mt-5 pt-5 b-submit-bg-m destopnone">
        <div class="container mt-4">
            <div class="row py-4">
                <div class="col-md-6 offset-md-3 px-4">
                    <h5 class=" text-center ">
                        <img src="{{ asset('images/web/white-down.png') }}" alt="420 Finder Logo" class="w-30">
                    </h5>
                    <h1 class="py-4 text-center t-white t-italic" style="font-size: 2.2rem;"><strong>BUSINESS SUBMITTED</strong></h1>
                    <div class="card-title text-center bg-light pb-3 shadow-sm p-3">
                        <h3 class="text-center t-gray t-italic" style="font-weight: 900">Congratulations!</h3>
                        <p class="text-center t-gray t-italic mb-3" style="font-size: 0.9rem;">your business account is now active you can access your business dashboard <a href="{{route('profile')}}" class="t-color t-under"><strong>here</strong></a> </p>
                        <p class="text-center t-italic t-gray m-0">NOTICE:</p>
                        <p class="text-center t-italic t-gray m-0" style="font-size: 0.8rem;">The business you recently submited is still pending final admin approval. We will be notified whenever you have been approved.</p>
                    </div>
                    <div class="mt-4 text-center">
                        <img src="{{ asset('images/web/white-logo.png') }}" alt="420 Finder Logo" class="w-30">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
