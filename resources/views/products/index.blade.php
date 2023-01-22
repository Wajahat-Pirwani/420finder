@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

      <!-- ======= Hero Section ======= -->
      @if (count($slidesdesktop) > 0)
      <section class="hero-section">
          <div class="container px-0">

              <!-- For Desktop -->

              <div id="carouselDesktop" class="carousel slide forDesktop" data-bs-ride="carousel">

                  <div class="carousel-indicators">

                      @if(count($slidesdesktop) > 0)

                          @foreach($slidesdesktop as $index => $single)

                              @if($index < 5)

                                  <button type="button" data-bs-target="#carouselDesktop" data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif" @if($index == 0) aria-current="true" @endif aria-label="Slide {{ $index }}"></button>

                              @endif

                          @endforeach

                      @endif

                  </div>

                  <div class="carousel-inner">
                      @if(count($slidesdesktop) > 0)


                          @foreach($slidesdesktop as $index => $slide)

                          <?php
                             $images = json_decode($slide->slide, true);
                            ?>
                              @if($index < 5)
                                  {{-- <a href="{{ $slide->url }}" target="_blank"> --}}
                                  <div class="carousel-item @if($index == 0) active @endif">

                                      <img src="{{ $images['desktop'] }}" class="d-block w-100 br-30" alt="..." onclick="location.href = '{{ $slide->url }}'" style="cursor: pointer;">

                                  </div>
                                   {{-- </a> --}}
                              @endif

                          @endforeach

                      @endif

                  </div>

                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselDesktop" data-bs-slide="prev">

                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>

                  </button>

                  <button class="carousel-control-next" type="button" data-bs-target="#carouselDesktop" data-bs-slide="next">

                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>

                  </button>

              </div>

              <!-- For Mobile -->
              <div id="carouselMobile" class="carousel slide forMobile" data-bs-ride="carousel">

                  <div class="carousel-indicators">

                      {{-- @if(count($slidesmobile) > 0)

                          @foreach($slidesmobile as $index => $single) --}}

                          @if(count($slidesdesktop) > 0)

                          @foreach($slidesdesktop as $index => $single)


                              @if($index < 5)

                                  <button type="button" data-bs-target="#carouselMobile" data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif" @if($index == 0) aria-current="true" @endif aria-label="Slide {{ $index }}"></button>

                              @endif

                          @endforeach

                      @endif

                  </div>

                  <div class="carousel-inner">

                          @if(count($slidesdesktop) > 0)

                          @foreach($slidesdesktop as $index => $slide)

                          <?php
                             $images = json_decode($slide->slide, true);
                            ?>

                              @if($index < 5)
                                      <div class="carousel-item @if($index == 0) active @endif">

                                          <img src="{{ $images['mobile'] }}" class="d-block w-100" alt="..." onclick="location.href = '{{ $slide->url }}'" style="cursor: pointer;">
                                      </div>
                              @endif

                          @endforeach

                      @endif

                  </div>

                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselMobile" data-bs-slide="prev">

                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>

                  </button>

                  <button class="carousel-control-next" type="button" data-bs-target="#carouselMobile" data-bs-slide="next">

                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>

                  </button>

              </div>


          </div>
      </section><!-- End Hero -->
      @endif


    <div class="products-head {{ count($slidesdesktop) < 1 ? 'slides-empty' : ''}}">
        <div class="container">
            <h4>Products</h4>
        </div>
    </div>

    {{-- BROWSE BY CATEGORY --}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-8">
                    <h5 style="font-weight: 600;" class="pb-2">Browse by category</h5>
                </div>
                {{-- <div class="col-md-4 col-4 text-end">
                    <a href="{{ route('categories') }}" style="font-weight: 600;">View all ></a>
                </div> --}}
            </div>
            <div class="row">
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                        <a href="{{ route('products.category', ['category' => $category['slug']]) }}" class="col-md-3 col-6 mb-3">
                            <div class="card border shadow-sm">
                              <img src="{{ $category->image }}" class="card-img-top" alt="Category Image">
                              <div class="card-body pt-1">
                                <div style="font-size: 1rem;letter-spacing: 0.00625rem;line-height: 2.25rem;text-align: center;">{{ $category->name }}</div>
                              </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection
