@extends('layouts.app')

    @section('title', '420 Finder')
    
    @section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 style="font-weight: 600;" class="pb-2">Search results ({{ $products->count() }})</h4>
                </div>
            </div>
            <div class="row">
              @if($products->count() > 0)
                  @foreach($products as $product)
                      <div class="col-md-3 mb-4 cursor-pointer" onclick="location.href='{{ route('brandproductsingle', ['slug' => $product['slug'], 'id' => encrypt($product->id)]) }}';">
                          <div class="card shadow-sm">
                            <img src="{{ $product->image }}" class="card-img-top" alt="...">
                            <div class="card-body pt-1 border-top">
                              <div style="font-size: 1rem;font-weight: 700;letter-spacing: 0.00625rem;line-height: 1.25rem;padding-top: 10px">{{ substr($product->name, 0, 20) }}...</div>
                              <div class="py-2" style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">{{ $product->subcategory_names }}</div>
                              <ul class="list-unstyled d-flex ratings">
                                  <?php

                                      if (count($product['reviews']) > 0) {

                                          $sum = 0;
                                          foreach ($product['reviews'] as $review) {
                                              
                                              $sum = $sum + $review['rating'];

                                          }
                                          $totalratings = $sum / count($product['reviews']);

                                      } else {
                                          $totalratings = 0;
                                      }

                                      if ($totalratings < 1) {
                                          echo '
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings <= 1) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings > 1 AND $totalratings <=2) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings > 2 AND $totalratings <=3) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings > 3 AND $totalratings <=4) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="far fa-star"></i></a></li>
                                          ';
                                      } elseif ($totalratings > 4 AND $totalratings <=5) {
                                          echo '
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                              <li><a href="#"><i class="fa fa-star"></i></a></li>
                                          ';
                                      }

                                      echo " <span class='reviewCount'>(".count($product['reviews']).")</span>";

                                  ?>
                              </ul>
                            </div>
                          </div>
                      </div>
                  @endforeach
              @endif
            </div>
        </div>
    </section>

@endsection