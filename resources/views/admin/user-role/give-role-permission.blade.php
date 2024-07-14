
@extends('layouts.admin')
@section('title','Permission Assign')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Assign Permissions to Role</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Permissions Assign</li>
            </ol>
        </nav>
    </div>
    <div>

        {{-- <a href="#" class="btn btn-primary btn-sm rounded">Add New category</a> --}}
        <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#sliderModel">
            New Slider
        </button> --}}
    </div>
</div>
<style>
    .table tr td{
        vertical-align: middle;
    }
</style>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="left pull-left">
                    <p>Assign Permission To </p>
                    <h3>Role : <span>{{$role->name}}</span></h3>
                </div>
                <div class="right pull-right">
                    <a href="javascript:history.back()" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{url('/dashboard/users/roles/'.$role->id.'/give-permissions')}}" method="post">
                    @csrf
                    @method('put')
                    @foreach($groupedPermissions as $category => $types)

                    <div class="card">
                        <div class="card-header alert alert-primary d-flex justify-content-between">
                            <h4 class=" uppercase">{{ $category }}</h4>
                            <label class=" uppercase" for="selectall_{{$category}}">
                                <input type="checkbox" name="" id="selectall_{{$category}}" class="select_All me-1" data-category="{{$category}}">
                                Select ALL
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($types as $type => $permissions)
                                    @foreach($permissions as $index => $permission)

                                    <div class="col-lg-2 col-md-2 col-sm-4">
                                        <label for="permission_{{$permission->id}}">
                                            <input type="checkbox" name="permission[]"
                                            id="permission_{{$permission->id}}"
                                            value="{{$permission->name}}"
                                            data-category="{{$category}}"
                                            @if(in_array($permission->id, $rolePermission->pluck('pivot.permission_id')->toArray())) checked @endif
                                            >
                                            <span class=" uppercase">
                                                {{ $permission->name }}
                                            </span>
                                            <br>
                                        </label>
                                    </div>

                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @endforeach
                    <a href="javascript:history.back()" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>

                    <button type="submit" class="btn btn-success-light btn-lg pull-right">Save</button>
                </form>

            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </div>
</div>

@endsection

@push('product')
<script>
    $(document).ready(function() {
        function updateSelectAll(category) {
            var allChecked = $(`input[type='checkbox'][data-category='${category}']:not(.select_All)`).length === $(`input[type='checkbox'][data-category='${category}']:not(.select_All):checked`).length;
            $(`#selectall_${category}`).prop('checked', allChecked);
        }

        $('.select_All').change(function() {
            var category = $(this).data('category');
            var checkboxes = $(`input[type='checkbox'][data-category='${category}']:not(.select_All)`);
            checkboxes.prop('checked', $(this).prop('checked'));
        });

        $('input[type="checkbox"]:not(.select_All)').change(function() {
            var category = $(this).data('category');
            updateSelectAll(category);
        });

        // Initialize the state of the select all checkboxes on page load
        $('.select_All').each(function() {
            var category = $(this).data('category');
            updateSelectAll(category);
        });
    });
</script>
@endpush
