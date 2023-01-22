@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4">
          <div class="row">
              <div class="col-md-6 offset-md-3">
                <h5 class="card-title text-center py-3">
                  <img src="{{ asset('assets/img/logo.png') }}" alt="420 Finder Logo" class="w-25">
                </h5>
                <form action="{{ route('saveabusiness') }}" method="POST" class="mb-5" id="add-business">
                  @csrf
                  <div class="">
                    <h5><strong>Add your business</strong></h5>
                    <p>Complete and submit the form below. Your business will appear on 420 Finder <strong>after our account team contacts you</strong> and verifies the information.</p>
                    <p>If you are submitting this application on behalf of a company or other legal entity, you represent that you have the authority to bind such entity to the terms and conditions set forth herein.</p>
                  </div>
                  <div>
                    <h5 class="pt-5 pb-3"><strong>Contact</strong></h5>

                    @include('partials.success-error')

                    <div class="row">
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">First name*</label>
                          <input type="text" name="first_name" class="form-control" required="" value="{{ old('first_name') }}">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Last name*</label>
                          <input type="text" name="last_name" class="form-control" required="" value="{{ old('last_name') }}">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Phone number*</label>
                          <input type="text" name="phone_number" class="form-control" required="" id="phoneNumber" value="{{ old('phone_number') }}">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Business role*</label>
                          <select name="role" class="form-control" required="">
                            <option value="">Select a business role</option>
                            <option {{ old('role') == 'Advertising Manager' ? "selected" : "" }} value="Advertising Manager">Advertising Manager</option>
                            <option {{ old('role') == 'COO' ? "selected" : "" }} value="COO">COO</option>
                            <option {{ old('role') == 'Finance Manager' ? "selected" : "" }} value="Finance Manager">Finance Manager</option>
                            <option {{ old('role') == 'Partner' ? "selected" : "" }} value="Partner">Partner</option>
                            <option {{ old('role') == 'President' ? "selected" : "" }} value="President">President</option>
                            <option {{ old('role') == 'Marketing Manager' ? "selected" : "" }} value="Marketing Manager">Marketing Manager</option>
                            <option {{ old('role') == 'Operations Manager' ? "selected" : "" }} value="Operations Manager">Operations Manager</option>
                            <option {{ old('role') == 'Other' ? "selected" : "" }} value="Other">Other</option>
                          </select>
                        </div>
                      </div>
                        <div class="form-group pb-3">
                            <label for="">Email*</label>
                            <input type="email" name="email" class="form-control" required="" value="{{ old('email') }}">
                        </div>
                        <div class="form-group pb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required="">
                        </div>

                    </div>
                    <h5 class="pt-5 pb-3"><strong>Business</strong></h5>
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Business Name*</label>
                          <input type="text" name="business_name" class="form-control" required="" value="{{ old('business_name') }}">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Business Type*</label>
                          <select name="business_type" class="form-control" required="">
                            <option value="">Select a business type</option>
                            <option {{ old('business_type') == 'Brand' ? "selected" : "" }} value="Brand">Brand</option>
                            <option {{ old('business_type') == 'Dispensary' ? "selected" : "" }} value="Dispensary">Dispensary</option>
                            <option {{ old('business_type') == 'Delivery' ? "selected" : "" }} value="Delivery">Delivery</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                            <label for="">Business Phone Number*</label>
                            <input type="text" name="business_phone_number" required="" class="form-control" id="businessPhoneNumber" value="{{ old('business_phone_number') }}">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Country*</label>

                          <input id="country" type="text" name="country" readonly required="" class="form-control" value="United States">

                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group pb-3">
                          <label for="">Address Line 1</label>
                          <input id="address_line_1" type="text" name="address_line_1" class="form-control" required="" value="{{ old('address_line_1') }}">
                            <input id="latitude" type="hidden" name="latitude">
                            <input id="longitude" type="hidden" name="longitude">
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group pb-3">
                          <label for="">Address Line 2</label>
                          <input id="address_line_2" type="text" name="address_line_2" class="form-control" value="{{ old('address_line_2') }}">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">City</label>
                          <input id="city" type="text" name="city" class="form-control" readonly value="{{ old('city') }}">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
{{--                          <input type="text" id="state">--}}
                        <div class="form-group pb-3">
                          <label for="">State / Province</label>
                            <select required name="state_province" id="state_province" class="form-control"
                                    style="margin-bottom: 1.2rem;" readonly>
                                <option value="">Select State</option>
                                @foreach ($state as $row)
                                    <option value="{{ $row->id }}" > {{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Postal code</label>
                          <input id="postcode" type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}">
                        </div>
                      </div>
                      <div class="col-md-12 col-12">
                        <div class="form-group pb-3">
                          <label for="">Website</label>
                          <input type="text" name="website" id="website" class="form-control" value="{{ old('website') }}">
                        </div>
                      </div>
                    </div>
                    <h5 class="pt-5 pb-3"><strong>License</strong></h5>
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">License number*</label>
                          <input type="text" name="license_number" class="form-control" value="{{ old('license_number') }}">
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">License type</label>
                          <select name="license_type" class="form-control">
                            <option value="">Select a license type</option>
                            <option {{ old('license_type') == 'Adult-Use Cultivation' ? "selected" : "" }} value="Adult-Use Cultivation">Adult-Use Cultivation</option>
                            <option {{ old('license_type') == 'Adult-Use Mfg' ? "selected" : "" }} value="Adult-Use Mfg">Adult-Use Mfg.</option>
                            <option {{ old('license_type') == 'Adult-Use Nonstorefront' ? "selected" : "" }} value="Adult-Use Nonstorefront">Adult-Use Nonstorefront</option>
                            <option {{ old('license_type') == 'Adult-Use Retail' ? "selected" : "" }} value="Adult-Use Retail">Adult-Use Retail</option>
                            <option {{ old('license_type') == 'Distributor' ? "selected" : "" }} value="Distributor">Distributor</option>
                            <option {{ old('license_type') == 'Event' ? "selected" : "" }} value="Event">Event</option>
                            <option {{ old('license_type') == 'Medical Cultivation' ? "selected" : "" }} value="Medical Cultivation">Medical Cultivation</option>
                            <option {{ old('license_type') == 'Medical Mfg' ? "selected" : "" }} value="Medical Mfg">Medical Mfg</option>
                            <option {{ old('license_type') == 'Medical Nonstorefront' ? "selected" : "" }} value="Medical Nonstorefront">Medical Nonstorefront</option>
                            <option {{ old('license_type') == 'Medical Retail' ? "selected" : "" }} value="Medical Retail">Medical Retail</option>
                            <option {{ old('license_type') == 'Microbusiness' ? "selected" : "" }} value="Microbusiness">Microbusiness</option>
                            <option {{ old('license_type') == 'Testing Lab' ? "selected" : "" }} value="Testing Lab">Testing Lab</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="form-group pb-3">
                          <label for="">Expiration</label>
                          <input type="date" name="license_expiration" class="form-control" value="{{ old('license_expiration') }}">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="form-group pt-3 pb-4">
                      <label for="">
                        <input type="checkbox" value="1" name="terms[]" @if(is_array(old('terms')) && in_array(1, old('terms'))) checked @endif required=""> I have read and agree to the above terms and conditions.*
                      </label>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn appointment-btn w-100" style="margin-left: 0;" id="add-business-submit">Add Business</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#add-business").submit(function () {
                $("#add-business-submit").attr("disabled", true);
                return true;
            });

            $('#phoneNumber').on('change', function() {
                let phoneNumber = $('#phoneNumber').val();
                let x = phoneNumber.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                phoneNumber = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');

                $('#phoneNumber').val(phoneNumber);
            });

            $('#businessPhoneNumber').on('change', function() {
                let phoneNumber = $('#businessPhoneNumber').val();
                let x = phoneNumber.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                phoneNumber = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');

                $('#businessPhoneNumber').val(phoneNumber);
            });
            // $('#website').on('change', function() {
            //     let url = $('#website').val();
            //     let x = url.replace(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
            //     console.log(x);
            //     url = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            //
            //     $('#website').val(url);
            // });

        });
    </script>
    <script>
        let autocomplete = '';
        let postalField = '';
        let address1Field = '';
        let address2Field = '';
        function initAutocomplete() {
            address1Field = document.querySelector("#address_line_1");
            address2Field = document.querySelector("#address_line_2");
            postalField = document.querySelector("#postcode");

            // Create the autocomplete object, restricting the search predictions to
            // addresses in the US and Canada.
            autocomplete = new google.maps.places.Autocomplete(address1Field, {
                componentRestrictions: { country: "us" },
                fields: ["address_components", "geometry"],
                types: ["address"],
            });
            address1Field.focus();

            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete.addListener("place_changed", fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            const place = autocomplete.getPlace();
            let address1 = "";
            let postcode = "";

            document.querySelector("#latitude").value = autocomplete.getPlace().geometry.location.lat();
            document.querySelector("#longitude").value = autocomplete.getPlace().geometry.location.lng();


            // Get each component of the address from the place details,
            // and then fill-in the corresponding field on the form.
            // place.address_components are google.maps.GeocoderAddressComponent objects
            // which are documented at http://goo.gle/3l5i5Mr
            for (const component of place.address_components) {
                // @ts-ignore remove once typings fixed
                const componentType = component.types[0];




                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }

                    case "route": {
                        address1 += component.short_name;
                        break;
                    }

                    case "postal_code": {
                        postcode = `${component.long_name}${postcode}`;
                        break;
                    }

                    case "postal_code_suffix": {
                        postcode = `${postcode}-${component.long_name}`;
                        break;
                    }

                    case "locality":
                        document.querySelector("#city").value = component.long_name;
                        break;

                    case "administrative_area_level_1": {
                        // document.querySelector("#state").value = component.long_name;

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "/api/states",
                            method:"GET",
                            success:function(data) {

                                data.forEach(myFunction)

                                function myFunction(item, index, arr) {

                                    if(arr[index].name == component.long_name){
                                        console.log(arr[index].id);
                                        document.querySelector("#state_province").value = arr[index].id;

                                    }
                                }
                            }
                        });


                        break;
                    }

                    case "country":
                        document.querySelector("#country").value = component.long_name;
                        break;
                }
            }

            address1Field.value = address1;
            postalField.value = postcode;

            // After filling the form with address components from the Autocomplete
            // prediction, set cursor focus on the second address line to encourage
            // entry of subpremise information such as apartment, unit, or floor number.
            address2Field.focus();
        }
        google.maps.event.addDomListener(window, 'load', initAutocomplete);

    </script>
@endpush
