{{-- Modal subcategory add --}}

<!-- Modal -->
<div class="modal fade" id="adsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Ads Banner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- <div class="category_form" id="category_form"></div> --}}
        <form action="{{route('ads.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('POST')
            <div class="modal-body">

                <div class="row g-3">
                    <div class="col-md-6 mb-2">
                        <label for="ads_header" class="form-label">Header Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ads_header" name="ads_header" placeholder="Header Title" required>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="ads_title" class="form-label">Main Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ads_title" name="ads_title" placeholder="Main Title" required>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="btnText" class="form-label">Button Text</label>
                        <input type="text" class="form-control" id="btnText" name="btnText" placeholder="Button Text">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="shop_url" class="form-label">Button URL</label>
                        <input type="text" class="form-control" id="shop_url" name="shop_url" placeholder="Button URL">
                    </div>

                    <div class="col-6 col-md-6 mb-2">
                        <div class="form-check ml-20">
                          <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" onchange="toggleAdsNoField()">
                          <label class="form-check-label" for="is_featured">
                            Do you want to featured this ads?
                          </label>
                        </div>

                    </div>
                    <div class="col-6 col-lg-6 col-md-6 mb-2" id="adsNoField" style="display: none;">
                        <label for="is_feature_no" class="form-label">Position No. </label>
                        <select class="form-control" id="is_feature_no" name="is_feature_no">
                            <option value="0">Select Position No.</option>
                            <option value="1">1. After New Arrival</option>
                            <option value="2">2. After Campaign</option>
                            <option value="3">3. After Popular Products</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="ads_image" class="form-label">Ads Banner Image<span class="text-danger">*</span></label>
                      <input type="file" class="form-control" id="ads_image" name="ads_image" required>
                    </div>

                    <div class="col-12 mb-4">
                        <div id="image-preview">
                            <img id="output-image" src="" alt=""  width="250px">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                      {{-- <button class="btn btn-primary" type="submit">Submit form</button> --}}
                    </div>
                </div>
            </div>
        </form>
        {{-- <div class="modal-footer">
        </div> --}}
      </div>
    </div>
</div>


<script>
    document.getElementById('ads_image').addEventListener('change', function (event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const outputImage = document.getElementById('output-image');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                outputImage.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    });


    function toggleAdsNoField() {
        var adsNoField = document.getElementById('adsNoField');
        var checkbox = document.getElementById('is_featured');

        if (checkbox.checked) {
            adsNoField.style.display = 'block';
        } else {
            adsNoField.style.display = 'none';
        }
    }

</script>

