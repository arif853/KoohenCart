@extends('layouts.admin')
@section('title','Edit Product')
@section('content')

<link href="{{asset('admin/assets/vendors/form-wizard/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />
<link href="{{asset('admin/assets/css/product-form.css')}}" rel="stylesheet" />

<div class="product-form-page">

    <div class="pf-page-header">
        <div>
            <a href="{{ route('products.index') }}" class="pf-back-link">
                <i class="fa-solid fa-arrow-left"></i> Back to products
            </a>
            <h2 class="mt-2">Update Product</h2>
            <p>Editing <strong>{{ $products->product_name }}</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="wizard-container">
                <div class="card wizard-card" data-color="azzure" id="wizard">
                    <div class="card-header">
                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#details" data-toggle="tab"><span class="pf-step-num">1</span> Product Details</a></li>
                                <li><a href="#description" data-toggle="tab"><span class="pf-step-num">2</span> Description</a></li>
                                <li><a href="#additional" data-toggle="tab"><span class="pf-step-num">3</span> Additional Info</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="pf-error-banner">
                                <span class="pf-error-icon"><i class="fa-solid fa-exclamation"></i></span>
                                <div>
                                    <strong>Please fix the following before saving:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <form action="{{route('products.update',$products->id)}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('patch')

                            <div class="tab-content">
                                <div class="tab-pane" id="details">

                                    <div class="pf-section">
                                        <div class="pf-section-title">Basic information</div>
                                        <div class="row gx-3">
                                            <div class="mb-4">
                                                <label for="product_title" class="form-label">Product title <span class="text-danger">*</span></label>
                                                <input type="text" placeholder="Type here" class="form-control @error('product_name') is-invalid @enderror" id="product_title" value="{{ old('product_name', $products->product_name) }}" name="product_name" required>
                                                @error('product_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-md-4 mb-4">
                                                <label for="product_brand" class="form-label">Brand<span class="text-danger">*</span></label>
                                                <select class="select-nice @error('product_brand') is-invalid @enderror" id="product_brand" name="product_brand"  required>
                                                    <option value="" disabled>--Select a Brand--</option>
                                                    @foreach ($brands as $brand)

                                                    <option value="{{$brand->id}}" {{ old('product_brand', $products->brand_id) == $brand->id ? 'selected' : '' }} >{{$brand->brand_name}}</option>
                                                    @endforeach

                                                </select>
                                                @error('product_brand')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="product_category" class="form-label">Category<span class="text-danger">*</span></label>
                                                <select class="select-nice @error('product_category') is-invalid @enderror" id="product_category" name="product_category" onchange="category()" required>
                                                    <option value="" disabled>Select a Category....</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{ old('product_category', $products->category_id) == $category->id ? 'selected' : '' }}>{{$category->category_name}}</option>
                                                    @endforeach

                                                </select>
                                                @error('product_category')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label class="form-label">Tags <small class="fw-normal text-muted">(hit space)</small></label>
                                                <input type="hidden" name="tags" id="tagsArrayInput" value="">
                                                <input type="text" placeholder="Type and press space" class="form-control tag-input" spellcheck="false">
                                                <ul class="tag-content">
                                                    @if (old('tags') !== null)
                                                        @foreach (array_filter(array_map('trim', explode(',', old('tags')))) as $oldtag)
                                                        <li>{{ $oldtag }} <i class="uit uit-multiply"></i></li>
                                                        @endforeach
                                                    @else
                                                        @foreach ($products->tags as $oldtag)
                                                        <li>{{$oldtag->tag}} <i class="uit uit-multiply"></i></li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <div class="tag-details d-flex justify-content-between">
                                                    <p><span>10</span> tags remaining</p>
                                                    <button type="button"><i class="fa-solid fa-times"></i> Clear</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pf-section">
                                        <div class="pf-section-title">Product media</div>
                                        <div class="row gx-3">
                                            <div class="col-lg-6 mb-4">
                                                <div class="pf-uploader-header">
                                                    <label class="form-label">Product Thumbnail</label>
                                                    <span class="pf-hint text-success">Two thumbnail images only</span>
                                                </div>
                                                <label class="pf-uploader @error('product_thumbnail.*') is-invalid @enderror">
                                                    <input type="file" multiple name="product_thumbnail[]" id="imageInput3">
                                                    <span class="pf-uploader-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                                                    <div class="pf-uploader-title">Click to add more thumbnails</div>
                                                    <div class="pf-uploader-sub">JPG, PNG or WEBP, up to 5MB each</div>
                                                </label>
                                                @error('product_thumbnail.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @if ($products->product_thumbnail->count())
                                                <div class="row mt-3 pf-existing-images">
                                                    @foreach ($products->product_thumbnail as $productImage)
                                                    <div class="col-lg-3 col-4">
                                                        <div class="pf-thumb">
                                                            <img src="{{asset('storage/product_images/thumbnail/'.$productImage->product_thumbnail)}}" alt="{{$products->slug}}">
                                                            <button type="button" class="pf-thumb-remove delete_thumb" data-productimage-id="{{$productImage->id}}" title="Remove"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif

                                                <div id="imagePreview3" class="row mt-3">

                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="pf-uploader-header">
                                                    <label class="form-label">Product Images</label>
                                                    <span class="pf-hint text-success">All gallery images</span>
                                                </div>
                                                <label class="pf-uploader @error('product_image.*') is-invalid @enderror">
                                                    <input type="file" multiple name="product_image[]" id="imageInput2">
                                                    <span class="pf-uploader-icon"><i class="fa-solid fa-images"></i></span>
                                                    <div class="pf-uploader-title">Click to add more images</div>
                                                    <div class="pf-uploader-sub">Use Ctrl/Cmd to select multiple files</div>
                                                </label>
                                                @error('product_image.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                @if ($products->product_images->count())
                                                <div class="row mt-3 pf-existing-images">
                                                    @foreach ($products->product_images as $productImage)
                                                    <div class="col-lg-3 col-4">
                                                        <div class="pf-thumb">
                                                            <img src="{{asset('storage/product_images/'.$productImage->product_image)}}" alt="{{$products->slug}}">
                                                            <button type="button" class="pf-thumb-remove delete_image" data-productimage-id="{{$productImage->id}}" title="Remove"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif

                                                <div id="imagePreview2" class="row mt-3">

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane" id="description">

                                    <div class="pf-section">
                                        <div class="pf-section-title">Variants</div>
                                        <div class="pf-toggle-row">
                                            <input class="form-check-input" type="checkbox" id="showVariantFields" role="switch">
                                            <label class="form-check-label" for="showVariantFields">This product has color / size variants</label>
                                        </div>
                                        <div id="variantFields" style="display:none;">
                                            <div class="row gx-3">
                                                <div class="mb-4 col-md-6" >
                                                    <label for="product_color" class="form-label">Color</label>
                                                    <select id="product_color" class="js-select2" name="product_color[]" multiple="multiple">
                                                        @foreach ($colors as $color)
                                                        <option value="{{$color->id}}" {{ in_array($color->id, old('product_color', $products->colors->pluck('id')->all())) ? 'selected' : '' }}>{{$color->color_name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="mb-4 col-md-6" >
                                                    <label for="product_size" class="form-label">Size</label>
                                                    <select class="js-select2" id="product_size" name="product_size[]" multiple="multiple">
                                                        @foreach ($sizes as $size)
                                                        <option value="{{$size->id}}" {{ in_array($size->id, old('product_size', $products->sizes->pluck('id')->all())) ? 'selected' : '' }}>{{$size->size_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        // After a failed update, prefer what the admin just typed (old()) over the
                                        // saved overviews so the fix stays visible; only fall back to the DB rows
                                        // on a normal page load.
                                        $overviewNames = old('featurename');
                                        $overviewValues = old('featurevalue');
                                        if ($overviewNames === null) {
                                            $overviewNames = $products->overviews->mapWithKeys(fn($o, $i) => [$i + 1 => $o->overview_name])->all();
                                            $overviewValues = $products->overviews->mapWithKeys(fn($o, $i) => [$i + 1 => $o->overview_value])->all();
                                        }
                                    @endphp
                                    <div class="pf-section">
                                        <div class="pf-section-title">Quick overview <span class="text-danger">*</span></div>
                                        <div class="form-group">
                                            @foreach ($overviewNames as $index => $name)
                                            <div class="pf-repeat-row">
                                                <div class="col-lg-4">
                                                    <input class="form-control" type="text" id="featurename-{{ $index }}" name="featurename[{{ $index }}]" value="{{ $name }}" placeholder="Name" required>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" id="featurevalue-{{ $index }}" name="featurevalue[{{ $index }}]" value="{{ $overviewValues[$index] ?? '' }}" placeholder="Value" required>
                                                </div>
                                            </div>

                                            @endforeach

                                            <div class="form-group">
                                                <input type="hidden" name="totinput" id="totfield" value="{{ count($overviewNames) }}">
                                            </div>
                                        </div>
                                        <div id="morefield" >
                                            <div class="form-group">
                                                {{-- data will come from js --}}
                                            </div>
                                        </div>

                                        <div class="action-btn">
                                            <a class="add-btn" href="" onclick="event.preventDefault();addfield()" title="Add row"> <i class="fa-solid fa-plus"></i> </a>
                                            <a class="remove-btn" href="" onclick="event.preventDefault();removeField()" title="Remove last row"> <i class="fa-solid fa-minus"></i> </a>
                                        </div>
                                    </div>

                                    <div class="pf-section">
                                        <div class="pf-section-title">Description</div>
                                        <textarea placeholder="Type here" class="form-control @error('description') is-invalid @enderror" id="summernote" rows="8" name="description">{{ old('description', $products->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="tab-pane" id="additional">

                                    <div class="pf-section">
                                        <div class="pf-section-title">Sourcing &amp; price</div>
                                        <div class="row gx-3">
                                            <div class="col-md-4 mb-3">
                                                <label for="supplier" class="form-label">Supplier</label>
                                                <select class="select-nice" id="supplier" name="supplier">
                                                    <option value="">Select Supplier....</option>
                                                    @foreach ($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}" {{ old('supplier', $products->supplier_id) == $supplier->id ? 'selected' : '' }}>{{$supplier->supplier_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Supplier Price</label>
                                                <input type="number" placeholder="0.00" class="form-control @error('raw_price') is-invalid @enderror" value="{{ old('raw_price', $products->raw_price) }}" name="raw_price">
                                                @error('raw_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Selling Price<span class="text-danger">*</span></label>
                                                <input type="number" placeholder="0.00" class="form-control @error('regular_price') is-invalid @enderror" value="{{ old('regular_price', $products->regular_price) }}" name="regular_price" required>
                                                @error('regular_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        // Which mode was active for this product: prefer whatever the admin
                                        // just submitted (old()) so a validation failure doesn't silently
                                        // switch the selected radio; otherwise use the saved offer_type.
                                        // (Percentage and amount are both always stored regardless of which
                                        // one was picked - one is the real input, the other a derived display
                                        // value - so they can't be used to tell the modes apart.)
                                        $offerType = old('offer_type');
                                        if ($offerType === null) {
                                            $offerType = $products->product_price->offer_type ?? '';
                                        }
                                    @endphp
                                    <div class="pf-section">
                                        <div class="pf-section-title">Offer</div>
                                        <div class="row gx-3">
                                            <div class="col-lg-5">
                                                <div class="pf-offer-toggle-group mb-2">
                                                    <div class="form-check">
                                                        <input type="radio" id="percentage_checkbox" name="offer_type" value="percentage" class="form-check-input" {{ $offerType == 'percentage' ? 'checked' : '' }}>
                                                        <label for="percentage_checkbox" class="form-check-label">Percentage</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" id="price_checkbox" name="offer_type" value="amount" class="form-check-input" {{ $offerType == 'amount' ? 'checked' : '' }}>
                                                        <label for="price_checkbox" class="form-check-label">Fixed amount</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" id="no_offer_checkbox" name="offer_type" value="" class="form-check-input" {{ $offerType === '' ? 'checked' : '' }}>
                                                        <label for="no_offer_checkbox" class="form-check-label">No offer</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-7">
                                                <div class="offer-price mb-3" style="display: none">
                                                    <label for="percentage" class="form-label">Percentage (%)</label>
                                                    <input class="form-control @error('percentage') is-invalid @enderror" type="text" id="percentage" value="{{ old('percentage', $products->product_price->percentage ?? '') }}" name="percentage" placeholder="e.g. 15">
                                                    @error('percentage')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="offer-price-2" style="display: none">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input class="form-control @error('amount') is-invalid @enderror" type="text" id="amount" value="{{ old('amount', $products->product_price->amount ?? '') }}" name="amount" placeholder="e.g. 200">
                                                    @error('amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $additionalNames = old('additional_name');
                                        $additionalValues = old('additional_value');
                                        if ($additionalNames === null) {
                                            $additionalNames = $products->product_infos->mapWithKeys(fn($info, $i) => [$i + 1 => $info->additional_name])->all();
                                            $additionalValues = $products->product_infos->mapWithKeys(fn($info, $i) => [$i + 1 => $info->additional_value])->all();
                                        }
                                    @endphp
                                    <div class="pf-section">
                                        <div class="pf-section-title d-flex justify-content-between align-items-center w-100">
                                            <span>Additional info</span>
                                            <div class="action-btn">
                                                <a class="add-btn" data-bs-toggle="modal" data-bs-target="#additional_info" title="Add field"> <i class="fa-solid fa-plus"></i> </a>
                                            </div>
                                        </div>
                                        <div class="card-height ">
                                            <div class="form-group">
                                                @foreach ($additionalNames as $index => $name)
                                                <div class="pf-repeat-row">
                                                    <div class="col-lg-4">
                                                        <input class="form-control" type="text" id="additional_name-{{ $index }}" name="additional_name[{{ $index }}]" value="{{ $name }}">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input class="form-control" type="text" id="additional_value-{{ $index }}" name="additional_value[{{ $index }}]" value="{{ $additionalValues[$index] ?? '' }}" placeholder="Value">
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                            <div id="newfield" >
                                                <div class="form-group">
                                                    {{-- data will come from js --}}

                                                </div>
                                            </div>
                                            <div  class="form-group">
                                                <input type="hidden" name="totinput2" id="totfield2" value="{{ count($additionalNames) }}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous' name='previous' value='Previous' />
                                </div>
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next' name='next' value='Next' />
                                    <button class="btn btn-finish" type="submit" name='finish'>Save changes</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </div>
                </div> <!-- wizard container -->
            </div>
        <div class="col-lg-3">
            <div class="product_div">
                <div class="right-bar" id="right_bar">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="pf-section-title">Publishing</div>
                            <div class="mb-4">
                                <label class="form-label">Status<span class="text-danger">*</span></label>
                                <select class="select-nice @error('status') is-invalid @enderror" name="status" required>
                                    <option value="active" {{ old('status', $products->status) == 'active' ? 'selected' : '' }}>Published</option>
                                    <option value="inactive" {{ old('status', $products->status) == 'inactive' ? 'selected' : '' }}>Not Published</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="product_sku" class="form-label">SKU</label>
                                <input type="text" value="{{$products->sku}}" class="form-control" id="product_sku" name="sku" readonly>
                            </div>

                            <hr>
                            <div class="pf-section-title">Extra information</div>
                            @php
                                // product_extras is a hasMany but every product has at most
                                // one row; $extra used to be read straight off an empty
                                // foreach body, so a product with no extras row fataled on
                                // null->warranty_type the moment this page loaded.
                                $extra = $products->product_extras->first();
                            @endphp
                            <div class="mb-4">
                                <label class="form-label">Warranty Type</label>
                                <input type="text" value="{{ old('warranty', $extra->warranty_type ?? '') }}" placeholder="Warranty text.." class="form-control" name="warranty">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Return policy</label>
                                <input type="text" value="{{ old('return_policy', $extra->return_policy ?? '') }}" placeholder="Return policy" class="form-control" name="return_policy">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Delivery Type</label>
                                <select name="delivery_type" id="delivery_type" class="form-select">
                                    <option value="0">Select Delivery </option>
                                    <option value="1" {{ old('delivery_type', $extra->delivery_type ?? null) == '1' ? 'selected' : '' }}>Cash on delivery avilable</option>
                                    <option value="2" {{ old('delivery_type', $extra->delivery_type ?? null) == '2' ? 'selected' : '' }}>Cash on delivery not avilable</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">EMI</label>
                                <select class="form-select" name="emi">
                                    <option value="Available" {{ old('emi', $extra->emi ?? null) == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Not Available" {{ old('emi', $extra->emi ?? 'Not Available') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <!-- card end// -->

                </div>
            </div>
        </div>
    </form>

    </div>

</div>

  <!-- Modal -->
  <div class="modal fade" id="additional_info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Additional Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label" for="info_name">Field name</label>
                            <input class="form-control" type="text" id="info_name" name="info_name" placeholder="Ex.: Model">
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="event.preventDefault();getfield()">Save</button>
            </div>
      </div>
    </div>
  </div>


  <script>
    // Add a click event listener to the delete buttons
    // deleteimage
    document.querySelectorAll('.delete_image').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();

            // Get the product image ID
            var productImageId = element.getAttribute('data-productimage-id');
                console.log(productImageId);
            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to the delete route with the product image ID
                    // window.location.href = "{{ route('productsimage.destroy','') }}/" + productImageId;
                    $.ajax({
                    url: "{{ route('productsimage.destroy', '') }}" + "/" + productImageId,
                    method: 'DELETE',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        // Handle success, e.g., show a success message
                        Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                        // Optionally, you can refresh the page or update the UI
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        // Handle error, e.g., show an error message
                        Swal.fire('Error!', 'An error occurred while deleting the file.', 'error');
                    }
                });
                }
            });
        });
    });

      // Add a click event listener to the delete buttons
    //   Delete thumbnail
    document.querySelectorAll('.delete_thumb').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();

            // Get the product image ID
            var productImageId = element.getAttribute('data-productimage-id');
                console.log(productImageId);
            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to the delete route with the product image ID
                    // window.location.href = "{{ route('productsimage.destroy','') }}/" + productImageId;
                    $.ajax({
                    url: "{{ route('productsthumb.destroy', '') }}" + "/" + productImageId,
                    method: 'DELETE',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        // Handle success, e.g., show a success message
                        Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                        // Optionally, you can refresh the page or update the UI
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        // Handle error, e.g., show an error message
                        Swal.fire('Error!', 'An error occurred while deleting the file.', 'error');
                    }
                });
                }
            });
        });
    });

</script>
<script src="{{asset('admin/assets/js/script.js')}}"></script>
@endsection
