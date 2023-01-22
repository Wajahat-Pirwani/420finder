@extends('layouts.app')

    @section('title', '420 Finder')
    
    @section('content')

    <section class="fiveCols mt-5">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h5 style="font-weight: 600;" class="pb-2">Search Results ({{ count($businesses) }})</h5>
                </div>
            </div>
            <div class="row">
                @if(count($businesses) > 0)
                    @foreach($businesses as $business)
                        <a href="{{ route('dispensarysingle', ['name' => $business->business_name, 'id' => $business->id]) }}" class="col-md-2 col-6 mb-3">
                            <div class="card">
                                @if($business->profile_picture == '')
                                <div style="width: auto; height: 238px;" class="bg-light">
                                    <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top" alt="..." style="opacity: 0.3;padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                </div>
                                @else
                                    <img src="{{ $business->profile_picture }}" style="width: 238px; height: 238px;" class="card-img-top" alt="...">
                                @endif
                                <div class="card-body pt-1">
                                    <div style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;padding-top: 10px;">{{ $business->city }}, {{ $business->state_province }}</div>
                                    <div style="font-size: 1rem;font-weight: 700;letter-spacing: 0.00625rem;line-height: 1.25rem;">{{ $business->business_name }}</div>
                                    <div style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">{{ $business->license_type }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="col-md-6 offset-md-3 p-5 shadow-sm text-center">
                        <h4>No Result found.</h4>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection