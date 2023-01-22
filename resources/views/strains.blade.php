@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="fiveCols mt-5" style="background: url({{ $strainBanner->image }});background-size: 100%;">
        <div class="container" style="margin-top: 22px;">
            <div class="row">
                <div class="col-md-6">
                  <div class="pt-5 mt-5">
                    <h1 class="mb-3"><strong>Find your strain</strong></h1>
                    <form action="{{ route('searchstrain') }}" method="GET" class="d-flex">

                      <div class="form-group w-50">
                        <input type="text" name="search" placeholder="Search Strain" class="form-control" required="">
                      </div>
                      <div class="from-group">
                        <button class="appointment-btn btn ms-0" style="border-radius: 0;">Search</button>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          @if($posts->count() > 0)
            @foreach($posts as $post)
              <a href="{{ route('strainsingle', ['id' => $post->id]) }}" class="col-md-3 col-6 mb-4">
                <div class="card">
                  <div>
                    <img src="{{ $post->image }}" class="w-100">
                  </div>
                  <div class="pt-3 px-3">
                    <p class="text-black-50">
                      <?php
                        $genetic = App\Models\Genetic::where('id', $post->genetic_id)->select('name')->first();
                        echo $genetic->name;
                      ?>
                    </p>
                    <p>
                      <strong>
                        <?php
                          $strain = App\Models\Strain::where('id', $post->strain_id)->select('name')->first();
                          echo $strain->name;
                        ?>
                      </strong>
                    </p>
                  </div>
                </div>
              </a>
            @endforeach
          @endif
        </div>
      </div>
    </section>

@endsection
