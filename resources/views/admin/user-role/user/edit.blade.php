{{-- Modal subcategory add --}}

<!-- Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- <div class="category_form" id="category_form"></div> --}}
        <form id="userUpdateFrom">
            @csrf
            <input type="hidden" name="user_id" id="user_id">
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12 mb-2">
                        <label for="user_name" class="form-label">User Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="user_name" name="name" required>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="user_email" name="email" required>
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Set user password">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-2">
                      <label for="user_role" class="form-label">Roles<span class="text-danger">*</span></label>
                      <select name="user_role[]" id="user_role" class="form-select" multiple>
                        <option value="null">-- Selecte Use Role --</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                      </select>
                      @error('user_role')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <small>(Use Ctrl to selecte multiple.)</small>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>


