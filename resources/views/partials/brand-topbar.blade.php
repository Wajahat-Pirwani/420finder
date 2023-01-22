@php
  $contactDetail = '';
  $productmanagement = '';
  $manageverifications = '';
  $feeds = '';
  $payments = '';

  if($active == 'contact-details') {
    $contactDetail = 'navActive';
  } elseif($active == 'product-management') {
    $productmanagement = 'navActive';
  } elseif($active == 'manage-verifications') {
    $manageverifications = 'navActive';
  } elseif($active == 'feeds') {
    $feeds = 'navActive';
  } elseif($active == 'payments') {
    $payments = 'navActive';
  }

@endphp
<div class="row">
  <div class="col-md-10">
    <ul class="list-unstyled d-flex mb-0 pt-2">
      <li class="me-4 {{ $contactDetail }}">
        <h6>
          <a href="{{ route('viewprofilebrand', ['id' => $brand->id]) }}">CONTACT DETAILS</a>
        </h6>
      </li>
      <li class="me-4 {{ $payments }}">
        <h6 style="font-size: 1.1rem">
          <a href="{{ route('managebrandpayments', [$brand->slug, $brand->id]) }}">Payments</a>
        </h6>
      </li>
      <li class="me-4 {{ $productmanagement }}">
        <h6>
          <a href="{{ route('managebrandproducts', ['slug' => $brand->slug, 'id' => $brand->id]) }}">PRODUCT MANAGEMENT</a>
        </h6>
      </li>
      <li class="me-4 {{ $manageverifications }}">
        <h6>
          <a href="{{ route('manageverifications', ['slug' => $brand->slug, 'id' => $brand->id]) }}">MANAGE VERIFICATIONS</a>
        </h6>
      </li>
      <li class="me-4 {{ $feeds }}">
        <h6>
          <a href="{{ route('viewbrandfeeds', ['slug' => $brand->slug, 'id' => $brand->id]) }}">FEED</a>
        </h6>
      </li>
    </ul>
  </div>
  <div class="col-md-2 text-end">
    <a href="" class="appointment-btn" style="margin-left: 0px !important;">View brand <i class="fas fa-share"></i></a>
  </div>
</div>
