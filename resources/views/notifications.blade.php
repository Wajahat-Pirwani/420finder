@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4 mb-5 pb-5">
          <div class="row">
              <div class="col-md-6 offset-md-3">

                <h5 class="card-title py-3"><strong>Notifications</strong></h5>

                <div class="row">
                  @if($notifications->count() > 0)
                    @foreach($notifications as $notification)
                      <div class="col-md-12 mb-2">
                        <div class="card shadow-sm">
                          <div class="card-body">
                              <div class="row">
                                <div class="col-md-2 col-4">
                                  <img src="{{ $notification->image }}" alt="" style="width: 80px;height: 80px;padding: 5px;" class="img-thumbnail">
                                    @if($notification->status == 0)
                                        <mark class="dot"></mark>
                                    @endif
                                </div>
                                <div class="col-md-10 col-8">
                                    <a href="#" onclick="change('{{$notification->path}}', {{$notification->id}})">
                                      <div style="font-weight: bold;">{{ $notification->title }}</div>
                                      <div style="font-weight: 400;margin: 0px;padding: 0px;font-size: 14px;letter-spacing: 0.003125rem;line-height: 1.25rem;">{{ $notification->description }}</div>
                                      <div style="height: 1.125rem;color: rgb(155, 155, 155);margin-top: 6px;font-size: 12px;" class="text-black-50">{{ $notification->created_at->diffForHumans() }}</div>
                                    </a>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @else
                  <div class="col-md-12 text-center text-black-50 my-5">
                    <div class="emptyNotifications">
                      <i class="far fa-bell-slash"></i>
                    </div>
                    <h5>No notifications yet.</h5>
                  </div>
                  @endif
                </div>

              </div>
          </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        function change(link, id) {
            $.ajax({
                type: 'GET',
                url: '/notification/read/'+id,
                dataType: 'json',
                success: function (data) {
                    location.href = link
                },error:function(){
                    console.log(data);
                }
            })
        }
    </script>
@endpush

