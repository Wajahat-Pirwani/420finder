@extends('layouts.app')

    @section('title', '420 Finder')
    
    @section('content')

    <div class="container-fluid">

      <div class="row">
        
        <div class="col-md-12 text-center strainsingle" style="background-image: linear-gradient(0deg , rgb(0 0 0 / 61%) 0%, rgba(0, 0, 0, 0) 100%), url('{{ $post->image }}');background-position: center center;height: 400px;">

            <div class="container text-start brandTitle">
                <h1 class="text-white brandSingleTitle">
                  <?php
                    $strain = App\Models\Strain::where('id', $post->strain_id)->select('name')->first();
                    echo $strain->name;
                  ?>
                </h1>
                <div class="favBrand">
                    <i class="far fa-heart pe-4"></i> <span class="followers">
                      <?php
                        $genetic = App\Models\Genetic::where('id', $post->genetic_id)->select('name')->first();
                        echo $genetic->name;
                      ?>
                    </span>
                </div>
            </div>

        </div>

      </div>

    </div>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-4">
            <a href="{{ route('strains') }}">< Strains home</a>
          </div>
          <div class="col-md-12">
            <h4><strong>Description</strong></h4>
            <p>
              {{ $post->description }}
            </p>
          </div>
        </div>
      </div>
    </section>

@endsection