{{-- Modal category add --}}

<!-- Modal -->
<div class="modal fade" id="typeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Type of Offer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      
        <form method="post" action="{{ route('offerstype.create') }}">
           @csrf
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12 mb-4">
                      <label for="validationDefault01" class="form-label">Offer type Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="offer_type_name"  name="offer_type_name">
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


{{-- <script>
    document.getElementById('imageInput').addEventListener('change', function (event) {
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

</script> --}}
