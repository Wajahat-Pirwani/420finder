@include("partials/head")


{{--{{dd(request()->cookie())}}--}}
<div id="app">
  @include("partials/navigation")

  <main id="main" style="margin-top: 99px;">
       @yield('content')
  </main>
    @yield('starrating')
    @yield('scripts')
</div>
@include("partials/footer")
