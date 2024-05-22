{{-- Modal subcategory add --}}

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <div class="category_form" id="category_form"></div> --}}
            <form id="userStoreFrom">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12 mb-2">
                            <label for="name" class="form-label">User Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="User Name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Set user password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    <div class="col-md-12 mb-2">
                      <label for="role" class="form-label">Roles<span class="text-danger">*</span></label>
                      <select name="user_role[]" id="role" class="form-select" multiple>
                        <option value="null">-- Selecte Use Role --</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                      </select>
                      @error('user_role')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
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
