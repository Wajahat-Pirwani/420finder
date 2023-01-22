@extends('layouts.app')

    @section('title', '420 Finder')
    
    @section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4">
          <div class="row pt-5 customerLeftSidebar">
              <div class="col-md-3">
                @include('partials/sidebar')
              </div>
              <div class="col-md-9">
              </div>
          </div>
        </div>
    </section>

@endsection