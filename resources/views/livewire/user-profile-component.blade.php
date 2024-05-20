<div class="tab-pane fade show active profile-header" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    @php
    $user = Auth::guard('customer')->user();
    $fullName = $user->customer->firstName . ' ' . $user->customer->lastName;
    $Email = $user->customer->email ;
    $Phone = $user->customer->phone ;
    $billing_add = $user->customer->billing_address
    @endphp
    <h2>Profile</h2>
    <div class="row">
      <div class="col-lg-12 mb-4">
          <div class="card  mb-3" >
              <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Basic Info</h5>
                <a href="#" data-bs-toggle="modal" data-bs-target="#profile_modal" class="card-icon"><i class="fad fa-edit"></i></a>
              </div>
              <div class="card-body text-primary">
                  {{-- <p class="card-text"> <span class="mr-5">Name: </span> {{$b_district->bn_name}}</p> --}}
                  <p class="card-text"> <span class="mr-5" style="font-weight: 500">Name: </span> {{$fullName}}</p>
                  <p class="card-text"> <span class="mr-5" style="font-weight: 500">Email: </span> {{$Email}}</p>
                  <p class="card-text"> <span class="mr-5" style="font-weight: 500">Phone: </span> {{$Phone}}</p>
                  <p class="card-text"> <span class="mr-5" style="font-weight: 500">Address: </span> {{$billing_add}}</p>
              </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="profile_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content p-10">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{url('/customer/customer_update/'.$user->customer->id)}}" method="POST">
                          @csrf
                          @method('POST')
                          <div class="modal-body ">
                              <div class="row">
                                  <div class="col-lg-6">
                                      <div class="">
                                          <label for="" class="form-label text-dark">First name <span>*</span></label>
                                          <input type="text" required class="form-control mb-2" name="fname"
                                              placeholder="First name *" value="{{$user->customer->firstName}}">
                                      </div>
                                  </div>
                                  <div class="col-lg-6">
                                      <div class="">
                                          <label for="" class="form-label text-dark">Last name <span>*</span></label>
                                          <input type="text" required class="form-control mb-2" name="lname"
                                              placeholder="Last name *" value="{{$user->customer->lastName}}">
                                      </div>
                                  </div>

                                  <div class="col-lg-6">
                                      <div class="">
                                          <label for="" class="form-label text-dark">Phone <span>*</span></label>
                                          <input required type="text" class="form-control mb-2" name="phone"
                                              placeholder="Phone *" value="{{$user->customer->phone}}">
                                      </div>
                                  </div>
                                  <div class="col-lg-6">
                                      <div class="">
                                          <label for="" class="form-label text-dark">Email address <span>*</span></label>
                                          <input required type="text" class="form-control mb-2" name="email"
                                              placeholder="Email address *" value="{{$user->customer->email}}">
                                      </div>
                                  </div>

                                  <div class="col-lg-12">
                                      <div class="">
                                          <label for="" class="form-label text-dark">Address <span>*</span></label>
                                          <input type="text" class="form-control mb-2" name="billing_address" required
                                              placeholder="Address *" value="{{$user->customer->billing_address}}">
                                      </div>
                                  </div>
                                  {{-- @livewire('billing-area-component') --}}

                              </div>
                          </div>
                          <div class="modal-footer">
                              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                              <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                      </form>

                  </div>
              </div>
          </div>

      </div>

      <div class="col-lg-6 mb-4">
          <div class="card  mb-3" >
              <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Billing Address</h5>
                <a href="#" data-bs-toggle="modal" data-bs-target="#billing_modal" class="card-icon"><i class="fad fa-edit"></i></a>
                </div>
              <div class="card-body text-primary">
                  <p class="card-text"> <span style="font-weight: 500">Address:</span> {{$billing_add}}</p>
                  <p class="card-text"><span style="font-weight: 500">District:</span> {{ $customer_area->get('billing')->get('district') }},
                      <span class="card-text" style="font-weight: 500">Thana: </span>{{ $customer_area->get('billing')->get('upazilla') }}.</p>
                  <p class="card-text"><span style="font-weight: 500">PostOffice:</span> {{ $customer_area->get('billing')->get('area') }} {{ $customer_area->get('billing')->get('postcode') }}.</p>
              </div>
          </div>
           <!-- Billing Modify Modal -->
           <div class="modal fade" id="billing_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update billing info</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{url('customer/customer_billing_update/'.$user->customer->id)}}" method="POST">
                      @csrf
                      @method('POST')
                      <div class="modal-body ">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="">
                                      <label for="" class="form-label text-dark">Address <span>*</span></label>
                                      <input type="text" class="form-control mb-2" name="billing_address" required
                                          placeholder="Address *" value="{{$user->customer->billing_address}}">
                                          @error('billing_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="b_division" class="form-label text-dark">Division <span>*</span></label>
                                      <select class="form-control mb-2 division" name="b_division" id="b_division" required>
                                          <option value="0">Select Division...</option>
                                          @foreach($divisions as $division)
                                              <option value="{{ $division->id }}" {{ $division->id == $user->customer->division ? 'selected' : '' }}>{{ $division->name }}</option>
                                          @endforeach
                                      </select>
                                       @error('b_division')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="b_district" class="form-label text-dark">District <span>*</span></label>
                                      <select class="form-control mb-2 district" name="b_district" id="b_district" required>
                                          <option value="0">Select District...</option>
                                          @foreach ($districts as $district)
                                          <option value="{{$district->id}}" {{$district->id == $user->customer->district ? 'selected' : ''}}>{{$district->name}}</option>
                                          @endforeach
                                      </select>
                                       @error('b_district')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="b_area" class="form-label text-dark">Area/ Postoffice</label>
                                      <select class="form-control mb-2 area" name="b_area" id="b_area" required>
                                          <option value="0">Select Area/ Postoffice</option>
                                          @foreach ($postOffices as $postOffice)
                                          <option value="{{$postOffice->id}}" {{$postOffice->id == $user->customer->area ? 'selected' : ''}}>{{$postOffice->postOffice}}</option>
                                          @endforeach
                                      </select>
                                       @error('b_area')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>

                          </div>
                      </div>
                      <div class="modal-footer">
                          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                          <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                  </form>
              </div>
              </div>
          </div>
      </div>

      <div class="col-lg-6 mb-4">
          <div class="card  mb-3" >
              <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Shipping Address</h5>
                <div class="shipping-action-btn">
                  @if($customer_area->get('shipping'))
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modify_shipping_modal" class="card-icon p-2"><i class="fad fa-edit"></i></a>
                  @else
                  <a href="#" data-bs-toggle="modal" data-bs-target="#add_shipping_modal" class="card-icon p-2"><i class="fad fa-plus"></i></a>

                  @endif
                  </div>
                </div>
              <div class="card-body text-primary">
                  @if($customer_area->get('shipping'))
                  <p class="card-text"><span class="text-justify" style="font-weight: 500">Name : </span> {{$shipping->first_name}} {{$shipping->last_name}}</p>
                  <p class="card-text"><span class="text-justify" style="font-weight: 500">Email : </span> {{$shipping->s_email}}</p>
                  <p class="card-text"><span class="text-justify" style="font-weight: 500">Phone : </span> {{$shipping->s_phone}}</p>
                  <p class="card-text"><span class="text-justify" style="font-weight: 500">Address : </span> {{ $shipping->shipping_add }}.</p>
                  <p class="card-text"><span class="text-justify" style="font-weight: 500">District : </span> {{ $customer_area->get('shipping')->get('district') }},
                      <span class="card-text"> <span class="text-justify" style="font-weight: 500"> Thana : </span>{{ $customer_area->get('shipping')->get('upazilla') }}.</span></p>
                  <p class="card-text"><span class="text-justify" style="font-weight: 500">PostOffice : </span> {{ $customer_area->get('shipping')->get('area') }} {{ $customer_area->get('shipping')->get('postcode') }}.</p>
                  @else
                      <p class="text-danger">Please update your shipping info before order.</p>
                  @endif

              </div>
          </div>
          @if($customer_area->get('shipping'))
          <!-- Shipping Modify Modal -->
          <div class="modal fade" id="modify_shipping_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Shipping info</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{url('customer/shipping_update/'.$shipping->id)}}" method="POST">
                      @csrf
                      @method('POST')
                      <div class="modal-body">
                          <div class=row>
                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="" class="form-label text-dark">First name <span>*</span></label>
                                      <input type="text" class="form-control mb-2" required name="shipper_fname"
                                          placeholder="First name *" value="{{$shipping->first_name}}">
                                          @error('shipper_fname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="" class="form-label text-dark">Last Name <span>*</span></label>
                                      <input type="text" class="form-control mb-2"  name="shipper_lname"
                                          placeholder="Last name *" value="{{$shipping->last_name}}">
                                          @error('shipper_lname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                          </div>
                          <div class="row">

                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="" class="form-label text-dark">Phone <span>*</span></label>
                                      <input required class="form-control mb-2" type="text" name="shipper_phone"
                                          placeholder="Phone *" value="{{$shipping->s_phone}}">
                                          @error('shipper_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="" class="form-label text-dark">Email address <span>*</span></label>
                                      <input required class="form-control mb-2" type="text" name="shipper_email"
                                          placeholder="Email address *" value="{{$shipping->s_email}}">
                                          @error('shipper_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                          </div>
                          <div class="row">

                              <div class="col-lg-12">
                                  <div class="">
                                      <label for="" class="form-label text-dark">Shipping Address <span>*</span></label>
                                      <input type="text" class="form-control mb-2" name="shipper_address" required
                                          placeholder="Address *" value="{{$shipping->shipping_add}}">
                                          @error('shipper_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="s_division" class="form-label">Division <span>*</span></label>
                                      <select required class="form-control mb-2 division" name="s_division" id="s_division" value="{{$shipping->division}}">
                                          <option value="0">Select Division...</option>
                                          @foreach($divisions as $division)
                                              <option value="{{ $division->id }}" {{$division->id == $shipping->division ? 'selected' : ''}}>{{ $division->name }}</option>
                                          @endforeach
                                      </select>
                                      @error('s_division')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="s_district" class="form-label">District <span>*</span></label>
                                      <select required class="form-control mb-2 district" name="s_district" id="s_district">
                                          <option value="0">Select District...</option>
                                          @foreach ($districts as $district)
                                          <option value="{{$district->id}}" {{$district->id == $shipping->district ? 'selected' : ''}}>{{$district->name}}</option>
                                          @endforeach
                                      </select>
                                      @error('s_district')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="">
                                      <label for="s_area" class="form-label">Area/ Postoffice</label>
                                      <select required class="form-control mb-2 area" name="s_area" id="s_area">
                                          <option value="0">Select Area/ Postoffice</option>
                                          @foreach ($postOffices as $postOffice)
                                          <option value="{{$postOffice->id}}" {{$postOffice->id == $shipping->area ? 'selected' : ''}}>{{$postOffice->postOffice}} - {{$postOffice->postCode}}</option>
                                          @endforeach
                                      </select>
                                      @error('s_area')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                  </div>
                              </div>
                          </div>


                      </div>
                      <div class="modal-footer">
                          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                          <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                  </form>

              </div>
              </div>
          </div>
          @endif
           <!-- Shipping add Modal -->
          <div class="modal fade" id="add_shipping_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">New Shipping info</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{url('customer/newShipping')}}" method="POST">
                          @csrf
                          @method('POST')
                          <input type="hidden" name="customer_id" id="customer_id" value="{{$user->customer->id}}">
                          <div class="modal-body">
                              <div class=row>
                                  <div class="col-lg-6">
                                      <div class="">
                                          <label for="" class="form-label text-dark">First name <span>*</span></label>
                                          <input type="text" class="form-control mb-2" required name="shipper_fname"
                                              placeholder="First name *">
                                              @error('shipper_fname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>
                                  </div>
                                  <div class="col-lg-6">
                                      <div class="">
                                          <label for="" class="form-label text-dark">Last Name </label>
                                          <input type="text" class="form-control mb-2" name="shipper_lname"
                                              placeholder="Last name ">
                                              @error('shipper_lname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>
                                  </div>
                              </div>
                              <div class="row">

                                  <div class="col-lg-6">
                                      <div class="">
                                          <label for="" class="form-label text-dark">Phone <span>*</span></label>
                                          <input required class="form-control mb-2" type="text" name="shipper_phone"
                                              placeholder="Phone *">
                                              @error('shipper_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>
                                  </div>
                                  <div class="col-lg-6">
                                      <div class="">
                                          <label for="" class="form-label text-dark">Email address <span>*</span></label>
                                          <input required class="form-control mb-2" type="text" name="shipper_email"
                                              placeholder="Email address *">
                                              @error('shipper_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>
                                  </div>
                              </div>
                              <div class="row">

                                  <div class="col-lg-12">
                                      <div class="">
                                          <label for="" class="form-label text-dark">Shipping Address <span>*</span></label>
                                          <input type="text" class="form-control mb-2" name="shipper_address" required
                                              placeholder="Address *">
                                              @error('shipper_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>
                                  </div>
                              </div>

                              {{-- area seletor componet --}}
                              @livewire('area-select-component')

                          </div>
                          <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                      </form>

                  </div>
              </div>
          </div>

      </div>

      {{-- <div class="col-lg-6"></div> --}}
      {{-- <div class="col-lg-6">
          <form action="#">
              <div class="form-group">
                  <label for="default_shipping " class="form-label text-dark">Change Default Shipping address</label>
                  <select name="default_shipping" id="default_shipping" class="form-control">
                      <option value="">Select Shipping address</option>
                      <option value="">Shipping-1</option>
                      <option value="">Shipping-2</option>
                      <option value="">Shipping-3</option>
                  </select>
              </div>
          </form>
      </div> --}}
    </div>

  </div>
