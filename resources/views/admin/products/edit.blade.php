@extends('layouts.admin')
@section('title','Edit Product')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Update Product</h2>
        </div>
    </div>
</div>
<link href="{{asset('admin/assets/vendors/form-wizard/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />
<div class="row">
    <div class="col-lg-9">
        <!--      Wizard container        -->
        <div class="wizard-container">
            <div class="card wizard-card" data-color="azzure" id="wizard">
                <div class="card-header">
                    <!--        You can switch ' data-color="azzure" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

                        {{-- <div class="wizard-header">
                            <h3>
                            <b>LIST</b> YOUR BOAT <br>
                            <small>This information will let us know more about your boat.</small>
                            </h3>
                        </div> --}}
                    <div class="wizard-navigation">
                        <ul>
                            <li><a href="#details" data-toggle="tab">Product Details</a></li>
                            <li><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#additional" data-toggle="tab">Additional Info</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('products.update',$products->id)}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method('patch')

                        <div class="tab-content">
                            <div class="tab-pane" id="details">
                                {{-- <div class="card"> --}}
                                    {{-- <div class="card-body"> --}}
                                        <div class="row gx-3">
                                            <div class="mb-4">
                                                <label for="product_title" class="form-label">Product title <span class="text-danger">*</span></label>
                                                <input type="text" placeholder="Type here" class="form-control " id="product_title" value="{{$products->product_name}}" name="product_name" required>
                                            </div>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-md-4 mb-4">
                                                <label for="product_brand" class="form-label">Brand<span class="text-danger">*</span></label>
                                                <select class="select-nice" id="product_brand" name="product_brand"  required>
                                                    <option value="0">--Select a Brand--</option>
                                                    @foreach ($brands as $brand)

                                                    <option value="{{$brand->id}}" {{ $brand->id == $products->brand_id ? 'selected' : '' }} >{{$brand->brand_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="product_category" class="form-label">Category<span class="text-danger">*</span></label>
                                                <select class="select-nice" id="product_category" name="product_category" onchange="category()" required>
                                                    <option value="0">Select a Category....</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{ $category->id == $products->category_id ? 'selected' : '' }}>{{$category->category_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-4  mb-3">
                                                <div class="mb-4">
                                                    <label class="form-label">Tags <small>(hit space )</small></label>
                                                    <input type="hidden" name="tags" id="tagsArrayInput" value="">
                                                    <input type="text" placeholder="Type here" class="form-control tag-input" spellcheck="false">
                                                    <div class="tag-details d-flex justify-content-between">
                                                        <p><span>10</span> tags are remaining</p>
                                                        <button><i class="fa-solid fa-times"></i></button>
                                                    </div>
                                                    <ul class="tag-content">
                                                        @foreach ($products->tags as $oldtag)
                                                        <li>{{$oldtag->tag}}</li>
                                                        @endforeach
                                                    </ul>

                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4 mb-4">
                                                <label for="product_subcategory" class="form-label">Subcategory</label>
                                                <select name="product_subcategory" class="select-nice" id="product_subcategory" name="product_subcategory" >
                                                    <option value="0">Select a Subcategory....</option>
                                                    @foreach ($subcategories as $subcategory)
                                                    <option value="{{$subcategory->id}}" {{ $subcategory->category_id == $products->category_id ? 'selected' : '' }}>{{$subcategory->subcategory_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                        </div>

                                        <div class="row gx-3">
                                            {{-- <div class=" col-lg-12 mb-4">
                                                <label class="form-label">Product image<span class="text-danger">*</span></label>
                                                <input class="form-control" type="file" name="product_image" id="imageInput">
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <div id="image-preview">
                                                    <img id="output-image" src="" alt="" width="150px">
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Product Thumbnail <small class="text-success">(Two Thumbnail Image only.)</small></label>
                                                <input class="form-control" type="file" multiple name="product_thumbnail[]" id="imageInput3">
                                                {{-- <span><small>(Add multiple image, use ctrl or cmd key to select multiple image.)</small></span> --}}
                                                <div  class="row mt-4">
                                                    @foreach ($products->product_thumbnail as $productImage)
                                                    <div class="col-lg-3">
                                                        <div class="overlay-bg">
                                                            <div class="brand-overlay">
                                                                <div class="action-icon">
                                                                     <input type="hidden" name="productimage_id" value="{{$productImage->id}}" id="productimage_id">
                                                                    <a class="delete_image" data-productimage-id="{{$productImage->id}}" href="#"><i class="fa-solid fa-times"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{asset('storage/product_images/thumbnail/'.$productImage->product_thumbnail)}}" alt="{{$products->slug}}">
                                                        {{-- <button class="btn btn-danger btn-sm">Remove</button> --}}
                                                        <button class="btn btn-danger btn-sm delete_thumb mb-2"  data-productimage-id="{{$productImage->id}}"><i class="fa fa-times"></i></button>

                                                    </div>
                                                    @endforeach

                                                </div>
                                                <div id="imagePreview3" class="row mt-4">

                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Product images <small class="text-success">(Select product all images.)</small></label>
                                                <input class="form-control" type="file" multiple name="product_image[]" id="imageInput2">
                                                <span><small>(Add multiple image, use ctrl or cmd key to select multiple image.)</small></span>

                                                <div id="" class="row mt-4">

                                                    @foreach ($products->product_images as $productImage)
                                                    <div class="col-lg-3">
                                                        {{-- <div class="overlay-bg">
                                                            <div class="brand-overlay">
                                                                <div class="action-icon">
                                                                    <a href="{{ route('brands.edit', $brand->id) }}"  data-bs-toggle="modal" data-bs-target="#brandmodify"><i class="fa-regular fa-pen-to-square"></i></a>
                                                                    <input type="hidden" name="productimage_id" value="{{$productImage->id}}" id="productimage_id">
                                                                    <a class="delete_image" data-productimage-id="{{$productImage->id}}" href="#"><i class="fa-solid fa-times"></i></a>
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                        <img src="{{asset('storage/product_images/'.$productImage->product_image)}}" alt="{{$products->slug}}">
                                                        <button class="btn btn-danger btn-sm delete_image mb-2"  data-productimage-id="{{$productImage->id}}"><i class="fa fa-times"></i></button>

                                                    </div>
                                                    @endforeach

                                                </div>
                                                <div id="imagePreview2" class="row mt-4">

                                                </div>
                                            </div>

                                        </div>
                                    {{-- <div class="col-3 mb-4"> --}}

                                    {{-- </div> --}}
                                    {{-- </div> --}}
                                {{-- </div> --}}

                            </div>

                            <div class="tab-pane" id="description">
                                {{-- <h4 class="info-text">Do you include a captain? </h4> --}}
                                <div class="md-4">
                                    <div class="form-group checkbox-toggle">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" id="showVariantFields">
                                                Select Variants
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="variantFields" style="display:none;">
                                    <div class="mb-4 col-md-4" >
                                        <label for="product_color" class="form-label">Color</label>
                                        <select id="product_color" class="js-select2" name="product_color[]" multiple="multiple">
                                            {{-- <option value="red">Select a Color....</option> --}}
                                            @foreach ($colors as $color)
                                            <option value="{{$color->id}}" {{ $products->colors->contains('id', $color->id) ? 'selected' : '' }}>{{$color->color_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="mb-4 col-md-4" >
                                        <label for="product_size" class="form-label">Size</label>
                                        <select class="js-select2" id="product_size " name="product_size[]" multiple="multiple">
                                            {{-- <option value="red">Select a size....</option> --}}
                                            @foreach ($sizes as $size)
                                            <option value="{{$size->id}}" {{ $products->sizes->contains('id', $size->id) ? 'selected' : '' }}>{{$size->size_name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="mb-4 mt-4">
                                    <div class="form-group ">
                                        <h6>Quick Overview <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group">
                                        @foreach ($products->overviews as $index=> $overview)
                                        <div class="row mt-2">
                                            <div class="col-lg-4">
                                                {{-- <label class="pr-1" for="featurename-1">Name 1: </label> --}}
                                                <input class="form-control" type="text" id="featurename-1" name="featurename[{{$index+1}}]" value="{{$overview->overview_name}}" required>
                                            </div>
                                            <div class="col-lg-8">
                                                {{-- <label class="pr-1" for="featurevalue-1">Value 1: </label> --}}
                                                <input class="form-control" type="text" id="featurevalue-1" name="featurevalue[{{$index+1}}]" rows="1" value="{{$overview->overview_value}}" required>
                                            </div>
                                        </div>

                                        @endforeach

                                        <div class="form-group">
                                            <input type="hidden" name="totinput" id="totfield" value="{{$index+1}}">
                                        </div>
                                    </div>
                                    <div id="morefield" >
                                        <div class="form-group">
                                            {{-- data will come from js --}}
                                        </div>
                                    </div>

                                    <div class="action-btn d-flex justify-content-end">
                                        <a class="add-btn mt-4" href="" onclick="event.preventDefault();addfield()"> <i class="fa-solid fa-plus"></i> </a>
                                        <a class="remove-btn mt-4" href="" onclick="event.preventDefault();removeField()"> <i class="fa-solid fa-times"></i> </a>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Description</label>
                                    {{-- <div id="summernote"></div> --}}
                                    <textarea placeholder="Type here" class="form-control" id="summernote" rows="4" name="description">{{$products->description}}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane" id="additional">

                                <div class="mb-4">
                                    <div class="row gx-3">
                                        <div class="col-md-4">
                                            <label for="supplier" class="form-label">Supplier</label>
                                            <select class="select-nice" id="supplier" name="supplier">
                                                <option value="">Select Supplier....</option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{$supplier->id}}" {{ $supplier->id == $products->supplier_id ? 'selected' : '' }}>{{$supplier->supplier_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-4  mb-3">
                                            <label class="form-label">Supplier Price</label>
                                                <input type="number" placeholder="Supplier Price" class="form-control" value="{{$products->raw_price}}" name="raw_price">
                                        </div>
                                        <div class="col-md-4  mb-3">
                                            <label class="form-label">Selling Price<span class="text-danger">*</span></label>
                                            <input type="number" placeholder="Selling Price" class="form-control" value="{{$products->regular_price}}" name="regular_price" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label for="" class="me-2">Check if any offer avilable: </label>
                                            <div class="form-check d-inline-block">
                                                <input type="checkbox" id="percentage_checkbox" class="form-check-input" name="">
                                                <label for="percentage_checkbox" class="form-check-label me-2">
                                                    Percentage
                                                </label>
                                            </div>

                                            <div class="form-check d-inline-block">
                                                <input type="checkbox" id="price_checkbox" class="form-check-input" name="">
                                                <label for="price_checkbox" class="form-check-label me-2">
                                                    In Amount
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="offer-price" style="display: none">
                                                <label for="percentage" class="form-check-label me-2">Percentage(%)</label>
                                                <input class="form-control mb-2" type="text" id="percentage" value="{{$products->product_price->percentage}}" name="percentage" rows="1" placeholder="Enter percentage value.">
                                            </div>
                                            <div class="offer-price-2" style="display: none">
                                                <label for="amount" class="form-check-label me-2">In Amount</label>
                                                <input class="form-control mb-2" type="text" id="amount" value="{{$products->product_price->amount}}" name="amount" rows="1" placeholder="Enter amount value.">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" mb-4">
                                    <div class="">
                                        <h4 class="d-inline-block me-2">Additional Info</h4>
                                        <div class="action-btn d-inline-block ">
                                            <a class="add-btn" data-bs-toggle="modal" data-bs-target="#additional_info" > <i class="fa-solid fa-plus"></i> </a>
                                        </div>
                                        {{-- onclick="event.preventDefault();getfield()" --}}
                                    </div>
                                    {{-- overflow-scroll --}}
                                    <div class="card-height ">
                                        <div class="form-group">
                                            @foreach ($products->product_infos as $key => $additionalinfo)
                                            <div class="row mb-3">
                                                <div class="col-lg-4">
                                                    <input class="form-control" type="text" id="additional_name-1" name="additional_name[{{$key+1}}]" value="{{$additionalinfo->additional_name}}">
                                                </div>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" id="additional_value-1" name="additional_value[{{$key+1}}]" rows="1" value="{{$additionalinfo->additional_value}}" placeholder="Enter require field Value.">
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
                                            <input type="hidden" name="totinput2" id="totfield2" value="{{$key+1}}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-md btn-wd btn-sm' name='next' value='Next' />
                                {{-- <input type='button' class='btn btn-finish btn-fill btn-info btn-wd btn-sm' name='finish' value='Finish' /> --}}
                                <button class="btn btn-finish btn-fill btn-md btn-wd btn-sm" type="submit" name='finish'>Publish</button>
                            </div>
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
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
                        <!--<div class="mb-4">-->
                        <!--    <label class="form-label">Stock<span class="text-danger">*</span></label>-->
                        <!--   <input type="number" name="stock" class="form-control" id="stock" value="{{$products->stock}}" required>-->
                        <!--</div>-->
                        <div class="mb-4">
                            <label class="form-label">Status<span class="text-danger">*</span></label>
                            <select class="select-nice" name="status" required>
                                <option value="active" {{ $products->stock == 'active' ? 'selected' : '' }}>Published</option>
                                <option value="inactive" {{ $products->stock == 'inactive' ? 'selected' : '' }}>Not Published</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="product_sku" class="form-label">SKU</label>
                            <input type="text" value="{{$products->sku}}" class="form-control" id="product_sku" name="sku" readonly>
                        </div>

                        <hr>
                        <div class="mb-4">
                            <label class="form-label">Warranty Type</label>
                            @foreach ($products->product_extras as $extra)

                            @endforeach
                            <input type="text" value="{{$extra->warranty_type}}" placeholder="Warranty text.." class="form-control" name="warranty">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Return policy</label>
                            <input type="text" value="{{$extra->return_policy}}" placeholder="Return policy" class="form-control" name="return_policy">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Delivery Type</label>
                            <select name="delivery_type" id="delivery_type" class="form-select" name="delivery_type">
                                <option value="0">Select Delivery </option>
                                <option value="1" {{$extra->delivery_type == '1'? 'selected':''}}>Cash on delivery avilable</option>
                                <option value="2" {{$extra->delivery_type == '2'? 'selected':''}}>Cash on delivery not avilable</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">EMI</label>
                            <select class="form-select" name="emi">
                                <option value="Available" {{$extra->emi == 'Available'? 'selected':''}}>Available</option>
                                <option value="Not Available" {{$extra->emi == 'Not Available'? 'selected':''}}>Not Available</option>
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
                            <label class="pr-1" for="info_name">Name: </label>
                            <input class="form-control" type="text" id="info_name" name="info_name" placeholder="Ex.: Model">
                        </div>

                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="action-btn d-flex justify-content-end">
                        <a class="add-btn mt-4" href="" onclick="event.preventDefault();getfield()"> <i class="fa-solid fa-plus"></i> </a>
                        <a class="remove-btn mt-4" href="" onclick="event.preventDefault();removegetField()"> <i class="fa-solid fa-times"></i> </a>
                    </div>
                </div> --}}

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

    document.getElementById('imageInput2').addEventListener('change', function (event) {
        const input = event.target;
        const previewContainer = document.getElementById('imagePreview2');
        previewContainer.innerHTML = ''; // Clear existing previews


            if (input.files && input.files.length > 0) {
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'col-lg-3 mb-4';
                    const image = document.createElement('img');

                    const removeButton = document.createElement('button');

                    // Set up the remove button
                    removeButton.innerHTML = '<i class="fal fa-times"></i>';
                    removeButton.className = 'btn btn-danger btn-sm';
                    removeButton.addEventListener('click', function () {
                        // Remove the corresponding imageDiv when the remove button is clicked
                        previewContainer.removeChild(imageDiv);
                    });

                    // Set up the image
                    reader.onload = function (e) {
                        image.src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[i]);

                    // Append image and remove button to imageDiv
                    imageDiv.appendChild(image);
                    imageDiv.appendChild(removeButton);

                    previewContainer.appendChild(imageDiv);
                }

                // previewContainer.style.display = 'block'; // Assuming you want a flex container
            }
    });

    document.getElementById('imageInput3').addEventListener('change', function (event) {
        const input = event.target;
        const previewContainer = document.getElementById('imagePreview3');
        previewContainer.innerHTML = ''; // Clear existing previews


            if (input.files && input.files.length > 0) {
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'col-lg-3 mb-4';
                    const image = document.createElement('img');

                    const removeButton = document.createElement('button');

                    // Set up the remove button
                    removeButton.innerHTML = '<i class="fal fa-times"></i>';
                    removeButton.className = 'btn btn-danger btn-sm';
                    removeButton.addEventListener('click', function () {
                        // Remove the corresponding imageDiv when the remove button is clicked
                        previewContainer.removeChild(imageDiv);
                    });

                    // Set up the image
                    reader.onload = function (e) {
                        image.src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[i]);

                    // Append image and remove button to imageDiv
                    imageDiv.appendChild(image);
                    imageDiv.appendChild(removeButton);

                    previewContainer.appendChild(imageDiv);
                }

                // previewContainer.style.display = 'block'; // Assuming you want a flex container
            }
    });
    // create tags

    const ul = document.querySelector("ul.tag-content"),
        input = document.querySelector("input.tag-input"),
        tagsArrayInput = document.getElementById("tagsArrayInput"),
        tagNumb = document.querySelector(".tag-details span");

    let maxTags = 10,
        tags = [];

    countTags();
    createTag();

    function countTags() {
        input.focus();
        tagNumb.innerText = maxTags - tags.length;
        // Update the hidden input field with the serialized JSON of the tags array
        tagsArrayInput.value = tags;
    }

    function createTag() {
        ul.querySelectorAll("li").forEach((li) => li.remove());
        tags
            .slice()
            .reverse()
            .forEach((tag) => {
                let liTag = `<li>${tag} <i class="uit uit-multiply" onclick="remove(this, '${tag}')"></i></li>`;
                ul.insertAdjacentHTML("afterbegin", liTag);
            });
        countTags();
    }

    function remove(element, tag) {
        let index = tags.indexOf(tag);
        tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
        element.parentElement.remove();
        countTags();
    }

    function addTag(e) {
        if (e.key == "Enter" || e.keyCode == 32) {
            let tag = e.target.value.replace(/\s+/g, " ");
            if (tag.length > 1 && !tags.includes(tag)) {
                if (tags.length < 10) {
                    tag.split(",").forEach((tag) => {
                        tags.push(tag);
                        createTag();
                    });
                }
            }
            e.target.value = "";
        }
    }

    input.addEventListener("keyup", addTag);

    const removeBtn = document.querySelector(".tag-details button");
    removeBtn.addEventListener("click", () => {
        tags.length = 0;
        ul.querySelectorAll("li").forEach((li) => li.remove());
        countTags();
    });

</script>
@endsection
