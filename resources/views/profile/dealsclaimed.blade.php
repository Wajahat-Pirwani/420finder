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
                <div class="card p-3">
                  <h6>Deals Claimed ( {{ $deals->count() }} )</h6>

                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="table-responsive">

                        <table class="table table-hover">

                          <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <td>View</td>
                            <th>Created At</th>
                          </thead>

                          <tbody>
                            @if($deals->count() > 0)

                              @foreach($deals as $index => $claimed)

                                <tr>
                                  <td>{{ $index + 1 }}</td>
                                  <td>
                                    <?php
                                        $deal = App\Models\Deal::where('id', $claimed->deal_id)->select('title', 'picture')->first();
                                        echo $deal->title;
                                    ?>
                                  </td>
                                  <td>
                                    <img src="{{ $deal->picture }}" alt="{{ $deal->title }}" style="width: 30px;height: 30px;" class="img-thumbnail">
                                  </td>
                                  <td>
                                    <a href="{{ route('dealsingle', ['id' => $claimed->deal_id]) }}" class="btn border btn-sm bg-white">view</a>
                                  </td>
                                  <td>
                                    {{ $claimed->created_at }}
                                  </td>
                                </tr>

                              @endforeach

                            @else

                            @endif
                          </tbody>

                        </table>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
          </div>
        </div>
    </section>

@endsection
