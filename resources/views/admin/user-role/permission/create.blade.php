{{-- Modal subcategory add --}}

<!-- Modal -->
<div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">New Permission</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- <div class="category_form" id="category_form"></div> --}}
        <form id="permissionStoreForm" >
            @csrf
            <div class="modal-body">
                <p class="mb-4"><span class="text-warning">* Warning: </span> Make a permission name like <span class="text-warning">Type + ( Permission For )</span>.
                    You can add 4 types of permission ( Create, Update, Delete, View ). If you need other type contact technical team. <br>
                    <span class="text-success">Example: ( Create Order or Update Order )</span>
                   </p>
                <div class="row g-3">
                    <div class="col-md-12 mb-2">
                        <label for="name" class="form-label">Permission Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Permission Name" required>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>


