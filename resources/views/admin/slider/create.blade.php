{{-- Modal subcategory add --}}

<!-- Modal -->
<div class="modal fade" id="sliderModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Slider</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- <div class="category_form" id="category_form"></div> --}}
        <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('POST')
            <div class="modal-body">

                <div class="row g-3">
                    <div class="col-md-12 mb-2">
                        <label for="slider_title" class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="slider_title" name="slider_title" placeholder="Slider Title" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="slider_sub_title" class="form-label">Subtitle<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="slider_sub_title" name="slider_sub_title" placeholder="Slider Sub Title" required>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="btn-text" class="form-label">Button Text</label>
                        <input type="text" class="form-control" id="btnText" name="btnText" placeholder="Button Text">
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="slider_url" class="form-label">Button URL</label>
                        <input type="text" class="form-control" id="slider_url" name="slider_url" placeholder="Button URL">
                    </div>

                    <div class="col-md-12 mb-2">
                      <label for="slider_image" class="form-label">Slider Image<span class="text-danger">*</span></label>
                      <input type="file" class="form-control" id="slider_image" name="slider_image" >
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
    document.getElementById('slider_image').addEventListener('change', function (event) {
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




</script>

