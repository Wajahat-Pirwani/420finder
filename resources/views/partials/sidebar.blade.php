    @if(empty(session('customer_id')))
        <script>
            window.location.href = "{{route('signin')}}";
        </script>
    @endif
    <div class="row mb-4">
        <div class="col-md-4 col-4">
            @if($user->profile == NULL)
            <img src="{{ asset('dummy.png') }}" alt="profile" class="img-thumbnail text-center customerSideProfile" style="border-radius: 50%;">
            @else
              <img src="{{ $user->profile }}" alt="profile" class="img-thumbnail text-center customerSideProfile" style="border-radius: 50%;height: 86px;width: 86px;">
            @endif
        </div>
        <div class="col-md-8 col-8">
            <p class="mb-0 pb-1 pt-4"><strong>{{ session('customer_name') }}</strong>
               <span> {{ $customer_rating }} </span>
            </p>
            <a href="{{ route('accountsettings') }}">Edit account settings</a>
        </div>
    </div>
    <ul class="list-group customerSidebarUl mb-4">
        <li class="list-group-item">
            <a href="{{ route('orderhistory') }}"><i class="fas fa-car"></i> &nbsp; Order History</a>
        </li>

        <li class="list-group-item">
            <a href="{{ route('favorites') }}"><i class="fas fa-heart"></i> &nbsp; Favorites</a>
        </li>

        <li class="list-group-item">
            <a href="{{ route('recentlyviewed') }}"><i class="fas fa-history"></i> &nbsp; Recently viewed</a>
        </li>

        <li class="list-group-item">
            <a href="{{ route('dealsclaimed') }}"><i class="fas fa-history"></i> &nbsp; Deals Claimed</a>
        </li>

        <li class="list-group-item">
            <a href="{{ route('myreviews') }}"><i class="fas fa-history"></i> &nbsp; My reviews</a>
        </li>

        <li class="list-group-item">
            <a href="{{ route('accountsettings') }}"><i class="fas fa-cog"></i> &nbsp; Account settings</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('changepassword') }}"><i class="fas fa-key"></i> &nbsp; <b>Change Password</b></a>
        </li>

        <li class="list-group-item">
            <a href="{{ route('logout') }}" onclick="return confirm('Are you sure you want to logout?');"><i class="fas fa-sign-out-alt"></i> &nbsp; Logout</a>
        </li>
    </ul>
