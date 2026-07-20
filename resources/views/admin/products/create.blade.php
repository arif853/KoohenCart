@extends('layouts.admin')
@section('title','New Prodcut')

@section('content')

<link href="{{asset('admin/assets/vendors/form-wizard/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />
<link href="{{asset('admin/assets/css/product-form.css')}}" rel="stylesheet" />

<div class="product-form-page">

    <div class="pf-page-header">
        <div>
            <a href="{{ route('products.index') }}" class="pf-back-link">
                <i class="fa-solid fa-arrow-left"></i> Back to products
            </a>
            <h2 class="mt-2">New Product</h2>
            <p>Fill in the details below to add a new product to your catalog.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="wizard-container">
                <div class="card wizard-card" data-color="azzure" id="wizard">
                    <div class="card-header">
                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#details" data-toggle="tab" data-target="#details" role="tab"><span class="pf-step-num">1</span> Product Details</a></li>
                                <li><a href="#description" data-toggle="tab" data-target="#description" role="tab"><span class="pf-step-num">2</span> Description</a></li>
                                <li><a href="#additional" data-toggle="tab" data-target="#additional" role="tab"><span class="pf-step-num">3</span> Additional Info</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="pf-error-banner">
                                <span class="pf-error-icon"><i class="fa-solid fa-exclamation"></i></span>
                                <div>
                                    <strong>Please fix the following before publishing:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('POST')

                            <div class="tab-content">
                                <div class="tab-pane" id="details">

                                    <div class="pf-section">
                                        <div class="pf-section-title">Basic information</div>
                                        <div class="row gx-3">
                                            <div class="mb-4">
                                                <label for="product_title" class="form-label">Product title <span class="text-danger">*</span></label>
                                                <input type="text" placeholder="e.g. Koohen Premium Punjabi" class="form-control @error('product_name') is-invalid @enderror" id="product_title" name="product_name" value="{{ old('product_name') }}" required>
                                                @error('product_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-md-4 mb-4">
                                                <label for="product_brand" class="form-label">Brand<span class="text-danger">*</span></label>
                                                <select class="select-nice @error('product_brand') is-invalid @enderror" id="product_brand" name="product_brand"  required>
                                                    <option value="" selected disabled>--Select a Brand--</option>
                                                    @foreach ($brands as $brand)
                                                    <option value="{{$brand->id}}" {{ old('product_brand') == $brand->id ? 'selected' : '' }}>{{$brand->brand_name}}</option>
                                                    @endforeach

                                                </select>
                                                @error('product_brand')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="product_category" class="form-label">Category<span class="text-danger">*</span></label>
                                                <select class="select-nice @error('product_category') is-invalid @enderror" id="product_category" name="product_category"  required>
                                                    <option value="" selected disabled>Select a Category....</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{ old('product_category') == $category->id ? 'selected' : '' }}>{{$category->category_name}}</option>
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
                                                    @foreach (array_filter(array_map('trim', explode(',', old('tags', '')))) as $oldtag)
                                                    <li>{{ $oldtag }} <i class="uit uit-multiply"></i></li>
                                                    @endforeach
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
                                                    <label class="form-label">Product Thumbnail<span class="text-danger">*</span></label>
                                                    <span class="pf-hint text-success">Two thumbnail images only</span>
                                                </div>
                                                <label class="pf-uploader @error('product_thumbnail') is-invalid @enderror @error('product_thumbnail.*') is-invalid @enderror">
                                                    <input type="file" multiple name="product_thumbnail[]" id="imageInput3">
                                                    <span class="pf-uploader-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                                                    <div class="pf-uploader-title">Click to upload thumbnails</div>
                                                    <div class="pf-uploader-sub">JPG, PNG or WEBP, up to 5MB each</div>
                                                </label>
                                                @error('product_thumbnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @error('product_thumbnail.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div id="imagePreview3" class="row mt-3">

                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="pf-uploader-header">
                                                    <label class="form-label">Product Images<span class="text-danger">*</span></label>
                                                    <span class="pf-hint text-success">All gallery images</span>
                                                </div>
                                                <label class="pf-uploader @error('product_image') is-invalid @enderror @error('product_image.*') is-invalid @enderror">
                                                    <input type="file" multiple name="product_image[]" id="imageInput2">
                                                    <span class="pf-uploader-icon"><i class="fa-solid fa-images"></i></span>
                                                    <div class="pf-uploader-title">Click to upload images</div>
                                                    <div class="pf-uploader-sub">Use Ctrl/Cmd to select multiple files</div>
                                                </label>
                                                @error('product_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @error('product_image.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                        <option value="{{$color->id}}" {{ in_array($color->id, old('product_color', [])) ? 'selected' : '' }}>{{$color->color_name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="mb-4 col-md-6" >
                                                    <label for="product_size" class="form-label">Size</label>
                                                    <select class="js-select2" id="product_size" name="product_size[]" multiple="multiple">
                                                        @foreach ($sizes as $size)
                                                        <option value="{{$size->id}}" {{ in_array($size->id, old('product_size', [])) ? 'selected' : '' }}>{{$size->size_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pf-section">
                                        <div class="pf-section-title">Quick overview <span class="text-danger">*</span></div>
                                        <div class="form-group">
                                            <div class="pf-repeat-row">
                                                <div class="col-lg-4">
                                                    <input class="form-control" type="text" id="featurename-1" name="featurename[1]" value="{{ old('featurename.1', 'Fabric Type: ') }}" placeholder="Name" required>
                                                </div>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" id="featurevalue-1" name="featurevalue[1]" value="{{ old('featurevalue.1') }}" placeholder="Value" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="morefield" >
                                            <div class="form-group">
                                                @foreach (old('featurename', []) as $index => $oldFeatureName)
                                                    @continue($index == 1)
                                                    <div class="pf-repeat-row">
                                                        <div class="col-lg-4">
                                                            <input class="form-control" type="text" id="featurename-{{ $index }}" name="featurename[{{ $index }}]" value="{{ $oldFeatureName }}" placeholder="Name">
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" type="text" id="featurevalue-{{ $index }}" name="featurevalue[{{ $index }}]" value="{{ old('featurevalue.' . $index) }}" placeholder="Value">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div id="totfield" class="form-group">
                                            <input type="hidden" name="totinput" value="{{ max(1, count(old('featurename', []))) }}">
                                        </div>

                                        <div class="action-btn">
                                            <a class="add-btn" href="" onclick="event.preventDefault();addfield()" title="Add row"> <i class="fa-solid fa-plus"></i> </a>
                                            <a class="remove-btn" href="" onclick="event.preventDefault();removeField()" title="Remove last row"> <i class="fa-solid fa-minus"></i> </a>
                                        </div>
                                    </div>

                                    <div class="pf-section">
                                        <div class="pf-section-title">Description</div>
                                        <textarea placeholder="Describe the product..." class="form-control @error('description') is-invalid @enderror" id="summernote" rows="8" name="description">{{ old('description') }}</textarea>
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
                                                    <option value="{{$supplier->id}}" {{ old('supplier') == $supplier->id ? 'selected' : '' }}>{{$supplier->supplier_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Supplier Price</label>
                                                <input type="number" placeholder="0.00" class="form-control @error('raw_price') is-invalid @enderror" value="{{ old('raw_price') }}" name="raw_price">
                                                @error('raw_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Selling Price<span class="text-danger">*</span></label>
                                                <input type="number" placeholder="0.00" class="form-control @error('regular_price') is-invalid @enderror" value="{{ old('regular_price') }}" name="regular_price" required>
                                                @error('regular_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pf-section">
                                        <div class="pf-section-title">Offer</div>
                                        <div class="row gx-3">
                                            <div class="col-lg-5">
                                                <div class="pf-offer-toggle-group mb-2">
                                                    <div class="form-check">
                                                        <input type="radio" id="percentage_checkbox" name="offer_type" value="percentage" class="form-check-input" {{ old('offer_type') == 'percentage' ? 'checked' : '' }}>
                                                        <label for="percentage_checkbox" class="form-check-label">Percentage</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" id="price_checkbox" name="offer_type" value="amount" class="form-check-input" {{ old('offer_type') == 'amount' ? 'checked' : '' }}>
                                                        <label for="price_checkbox" class="form-check-label">Fixed amount</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" id="no_offer_checkbox" name="offer_type" value="" class="form-check-input" {{ old('offer_type', '') === '' ? 'checked' : '' }}>
                                                        <label for="no_offer_checkbox" class="form-check-label">No offer</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-7">
                                                <div class="offer-price mb-3" style="display: none">
                                                    <label for="percentage" class="form-label">Percentage (%)</label>
                                                    <input class="form-control @error('percentage') is-invalid @enderror" type="text" id="percentage" name="percentage" value="{{ old('percentage') }}" placeholder="e.g. 15">
                                                    <span class="pf-hint">Do not include the % sign</span>
                                                    @error('percentage')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="offer-price-2" style="display: none">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input class="form-control @error('amount') is-invalid @enderror" type="text" id="amount" name="amount" value="{{ old('amount') }}" placeholder="e.g. 200">
                                                    @error('amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pf-section">
                                        <div class="pf-section-title d-flex justify-content-between align-items-center w-100">
                                            <span>Additional info</span>
                                            <div class="action-btn">
                                                <a class="add-btn" data-bs-toggle="modal" data-bs-target="#additional_info" title="Add field"> <i class="fa-solid fa-plus"></i> </a>
                                            </div>
                                        </div>
                                        <div class="card-height ">
                                            <div class="form-group">
                                                <div class="pf-repeat-row">
                                                    <div class="col-lg-4">
                                                        <input class="form-control" type="text" id="additional_name-1" name="additional_name[1]" value="{{ old('additional_name.1', 'Frame :') }}">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input class="form-control" type="text" id="additional_value-1" name="additional_value[1]" value="{{ old('additional_value.1') }}" placeholder="Value">
                                                    </div>
                                                </div>
                                                <div class="pf-repeat-row">
                                                    <div class="col-lg-4">
                                                        <input class="form-control" type="text" id="additional_name-2" name="additional_name[2]" value="{{ old('additional_name.2', 'Weight Capacity :') }}">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input class="form-control" type="text" id="additional_value-2" name="additional_value[2]" value="{{ old('additional_value.2') }}" placeholder="Value">
                                                    </div>
                                                </div>
                                                <div class="pf-repeat-row">
                                                    <div class="col-lg-4">
                                                        <input class="form-control" type="text" id="additional_name-3" name="additional_name[3]" value="{{ old('additional_name.3', 'Width :') }}">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input class="form-control" type="text" id="additional_value-3" name="additional_value[3]" value="{{ old('additional_value.3') }}" placeholder="Value">
                                                    </div>
                                                </div>
                                                <div class="pf-repeat-row">
                                                    <div class="col-lg-4">
                                                        <input class="form-control" type="text" id="additional_name-4" name="additional_name[4]" value="{{ old('additional_name.4', 'Height :') }}">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input class="form-control" type="text" id="additional_value-4" name="additional_value[4]" value="{{ old('additional_value.4') }}" placeholder="Value">
                                                    </div>
                                                </div>
                                                <div class="pf-repeat-row">
                                                    <div class="col-lg-4">
                                                        <input class="form-control" type="text" id="additional_name-5" name="additional_name[5]" value="{{ old('additional_name.5', 'Wheels :') }}">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input class="form-control" type="text" id="additional_value-5" name="additional_value[5]" value="{{ old('additional_value.5') }}" placeholder="Value">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="newfield" >
                                                <div class="form-group">
                                                    @foreach (old('additional_name', []) as $index => $oldAdditionalName)
                                                        @continue($index <= 5)
                                                        <div class="pf-repeat-row">
                                                            <div class="col-lg-4">
                                                                <input class="form-control" type="text" readonly id="additional_name-{{ $index }}" name="additional_name[{{ $index }}]" value="{{ $oldAdditionalName }}">
                                                            </div>
                                                            <div class="col-lg-8 input-action">
                                                                <input class="form-control" type="text" id="additional_value-{{ $index }}" name="additional_value[{{ $index }}]" value="{{ old('additional_value.' . $index) }}" placeholder="Value">
                                                                <div class="btn-action ">
                                                                    <a class="rm-btn" onclick="event.preventDefault();removegetField(this)"> <i class="fa-solid fa-times"></i> </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id="totfield2" class="form-group">
                                                <input type="hidden" name="totinput2" value="{{ max(5, count(old('additional_name', []))) }}">
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
                                    <button class="btn btn-finish" type="submit" name='finish'>Publish product</button>
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
                                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Published</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Not Published</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="product_sku" class="form-label">SKU</label>
                                <input type="text" placeholder="Type here" class="form-control @error('sku') is-invalid @enderror" id="product_sku" name="sku" value="{{ old('sku') }}">
                                @error('sku')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr>
                            <div class="pf-section-title">Extra information</div>
                            <div class="mb-4">
                                <label class="form-label">Warranty Type</label>
                                <input type="text" placeholder="Warranty text.." class="form-control" name="warranty" value="{{ old('warranty') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Return policy</label>
                                <input type="text" placeholder="Return policy" class="form-control" name="return_policy" value="{{ old('return_policy') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Delivery Type</label>
                                <select name="delivery_type" id="delivery_type" class="form-select">
                                    <option value="0">Select Delivery </option>
                                    <option value="1" {{ old('delivery_type', '1') == '1' ? 'selected' : '' }}>Cash on delivery avilable</option>
                                    <option value="2" {{ old('delivery_type') == '2' ? 'selected' : '' }}>Cash on delivery not avilable</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">EMI</label>
                                <select class="form-select" name="emi">
                                    <option value="Available" {{ old('emi') == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Not Available" {{ old('emi', 'Not Available') == 'Not Available' ? 'selected' : '' }}>Not Available</option>
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
    // Auto-generate a SKU for this brand-new product. Create-only: the edit
    // page's SKU field is populated from the saved product and marked
    // readonly, so this script is never included there (see script.js).
    var generatedSKUs = [];

    function generateUniqueSKU() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var shuffledCharacters = shuffle(characters);

        do {
            var sku = shuffledCharacters.slice(0, 8);
        } while (generatedSKUs.includes(sku));

        generatedSKUs.push(sku);
        return sku;
    }

    function shuffle(str) {
        var array = str.split('');
        for (var i = array.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = array[i];
            array[i] = array[j];
            array[j] = temp;
        }
        return array.join('');
    }

    // Only auto-fill on a fresh form. After a failed submit the field already
    // carries the admin's previous SKU via old('sku') - overwriting it here
    // would silently swap in a different SKU than what's displayed/expected.
    var skuField = document.getElementById('product_sku');
    if (!skuField.value) {
        skuField.value = generateUniqueSKU();
    }
</script>
<script src="{{asset('admin/assets/js/script.js')}}"></script>
@endsection
