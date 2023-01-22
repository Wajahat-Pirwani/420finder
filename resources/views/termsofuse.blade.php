@extends('layouts.app')

    @section('title', '420 Finder')
    
    @section('content')

    <style>
        .nav-pills .nav-link {
            color: black;
            padding-bottom: 20px;
            text-align: left;
        }
        .nav-pills .nav-link.active {
            background: transparent;
            color: black;
            font-weight: 700;
        }
        .tab-pane.fade {
            border: 1px solid #e3e3e3;
            padding: 20px;
        }
        /* Style the tab */
        .tab {
            display: grid;
        }

        /* Style the buttons inside the tab */
        .tab button {
            border: none;
            padding: 14px 16px;
            text-align: left;
            background: transparent;
            border-bottom: 1px solid #e3e3e3;
        }
        .tabcontent {
            border: 1px solid #e3e3e3;
            padding: 20px;
            margin-top: 20px;
        }
        /* Change background color of buttons on hover */
        /*.tab button:hover {
          font-weight: 700;
        }*/

        /* Create an active/current tablink class */
        .tab button.active {
          font-weight: 600;
        }

        /* Style the tab content */
        .tabcontent {
          display: none;
        }
    </style>

    <section class="mt-5 pt-5">

        <div class="container pt-4 mt-4">

            <div class="row">

                <div class="col-md-12">
                    <h4>Terms of Use</h4>
                </div>

            </div>

            <div class="row">
            
                <div class="col-md-12">
                    
                    @if($terms->count() > 0)

                        <div class="row">
                            <div class="col-md-3">
                                <div class="tab">

                                    @foreach($terms as $index => $term)

                                        <button class="tablinks" onclick="openCity(event, 'tab{{ $index }}')">
                                            {{ $index + 1 }}. {{ $term->title }}
                                        </button>

                                    @endforeach

                                </div>
                            </div>
                            <div class="col-md-9">

                                @foreach($terms as $start => $single)

                                    <div id="tab{{ $start }}" class="tabcontent">
                                      {{ $single->description }}
                                    </div>

                                @endforeach

                            </div>
                        </div>

                    @else

                        <div class="text-center">
                            No Terms of Use.
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>
<script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
</script>
@endsection