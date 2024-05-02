<!-- Modal -->
<div class="modal fade" id="sizeChartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Size Chart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="sizeChartForm">
            <div class="modal-body">
                <div class="row g-3">
                    @foreach ($sizecharts as $chart)
                    <div class="col-lg-3 col-md-3 mb-2">
                        <label for="chest" class="form-label">Size<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" value="{{$chart->sizes->size_name}}" readonly>
                        <input type="hidden" name="sizes[{{ $chart->size_id }}][id]" value="{{ $chart->size_id }}">
                    </div>
                    <div class="col-lg-2 col-md-2 mb-2">
                        <label for="chest" class="form-label">Chest<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" name="sizes[{{ $chart->size_id }}][chest]" value="{{$chart->chest}}" required>
                    </div>

                    <div class="col-lg-2 col-md-2 mb-2">
                        <label for="length" class="form-label">Length<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" name="sizes[{{ $chart->size_id }}][length]" value="{{$chart->length}}" required>
                    </div>

                    <div class="col-lg-2 col-md-2 mb-2">
                        <label for="shoulder" class="form-label">Shoulder<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" name="sizes[{{ $chart->size_id }}][shoulder]" value="{{$chart->shoulder}}" required>
                    </div>

                    <div class="col-lg-2 col-md-2 mb-2">
                        <label for="sleeve" class="form-label">Sleeve<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-2" name="sizes[{{ $chart->size_id }}][sleeve]" value="{{$chart->sleeve}}" required>
                    </div>
                    @endforeach

                    <div class="col-12  mb-2">
                        <div class="form-check ml-10">
                            <input class="form-check-input" type="checkbox" name="status" id="status">
                            <label class="form-check-label" for="status">Publish</label>
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


