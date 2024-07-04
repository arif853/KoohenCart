
@extends('layouts.admin')
@section('title','Manage Permissions')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Manage Permissions</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Permissions</li>
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
                    {{-- <a href="#" class="btn btn-warning rounded">Permission</a> --}}
                    <button type="button" data-bs-toggle="modal" data-bs-target="#permissionModal" class="btn btn-info rounded mr-5 btn-sm">Add Permission</button>
                    <a href="{{url('/dashboard/roles')}}" class="btn btn-success rounded mr-5 btn-sm">Roles</a>
                    <a href="{{url('/dashboard/users/index')}}" class="btn btn-success rounded btn-sm">Users</a>
                </div>
                <div class="right pull-right">
                </div>

            </div>
            <div class="card-body">
                <p class="mb-4"><span class="text-warning">* Warning: </span> Make a permission name like <span class="text-warning">Type + ( Permission For )</span>.
                    You can add 4 types of permission ( Create, Update, Delete, View ). If you need other type contact technical team. <br>
                    <span class="text-success">Example: ( Create Order or Update Order )</span>

                    {{-- Bulk Delete btn --}}
                    <form id="bulkDeleteForm" method="POST" action="{{ route('permissions.bulkDelete') }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger mb-4 delete" id="bulkDeleteButton" style="display: none;">Delete Selected</button>
                    </form>
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>#</th>
                            <th>Permission Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_permissions[]" value="{{$permission->id }}" class="selectCheckbox">
                            </td>
                            <td>{{$key + 1}}</td>
                            <td>{{$permission->name}}</td>

                            <td>
                                @if($permission->name =='Super Admin')
                                <form class="deleteForm" action="{{ url('/dashboard/roles/'.$permission->id.'/delete') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit d-none"
                                    data-bs-toggle="modal" data-bs-target="#roleUpdateModal" data-permission-id="{{ $permission->id}}">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-sm font-sm btn-light rounded delete d-none">
                                        <i class="material-icons md-delete_forever"></i> Delete
                                    </a>
                                </form>
                                @else
                                <form class="deleteForm" action="{{ url('/dashboard/permissions/'.$permission->id.'/delete') }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit mr-5"
                                    data-bs-toggle="modal" data-bs-target="#permissionUpdateModal" data-permission-id="{{ $permission->id}}">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-sm font-sm btn-light rounded delete">
                                        <i class="material-icons md-delete_forever"></i> Delete
                                    </a>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </div>
</div>

<script>
    document.getElementById('selectAll').addEventListener('change', function(e) {
        let checkboxes = document.querySelectorAll('.selectCheckbox');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
        toggleBulkDeleteButton();
    });

    document.querySelectorAll('.selectCheckbox').forEach(checkbox => {
        checkbox.addEventListener('change', toggleBulkDeleteButton);
    });

    function toggleBulkDeleteButton() {
        let selected = document.querySelectorAll('.selectCheckbox:checked').length;
        document.getElementById('bulkDeleteButton').style.display = selected > 0 ? 'block' : 'none';
    }

    document.getElementById('bulkDeleteButton').addEventListener('click', function(event) {
        event.preventDefault();

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
                document.getElementById('bulkDeleteForm').submit();
            }
        });
    });
</script>

@include('admin.user-role.permission.edit')
@include('admin.user-role.permission.create')

@endsection
@push('product')
<script>

// $(document).ready(function{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        // Edit permission
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var permissionId = $(this).data('permission-id');

        var editURL = "{{url('')}}"+ '/dashboard/permissions/'+permissionId+'/edit';
        // console.log(editURL);

        $.ajax({
            url: editURL,
            method: 'GET',
            data: {
                id: permissionId,
            },
            success: function (response) {
                $('#permission_id').val(response.permission.id);
                $('#permission_name').val(response.permission.name);
            }
        });
    });

    //Store permissions
    $("#permissionStoreForm").submit(function (e) {
        e.preventDefault();

        const data = new FormData(this);
        // console.log(data);
        $.ajax({
            url: '{{url('/dashboard/permissions')}}',
            method: 'post',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 200) {
                    // $("#sliderEditModal").modal('hide');
                    location.reload();
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                $.Notification.autoHideNotify('danger', 'top right', 'Danger', xhr.responseJSON.errors.name[0]);
                $("#permissionModal").modal('hide');
            }
        })
    });

    //Update Role
    $("#permissionUpdateForm").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        var permissionId = $('#permission_id').val();
        console.log(permissionId);
        console.log(data);

        $.ajax({
            url: '{{url('dashboard/permissions/')}}'+'/'+permissionId,
            method: 'post',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                // console.log(res);
                if (res.status == 200) {
                    // $("#sliderEditModal").modal('hide');
                    location.reload();
                }
                // else{
                //     $.Notification.autoHideNotify('danger', 'top right', 'Danger', res);
                // }
            },
            error: function (xhr, textStatus, errorThrown) {
                $.Notification.autoHideNotify('danger', 'top right', 'Danger', xhr.responseJSON.errors.name[0]);
                $("#roleUpdateModal").modal('hide');
            }
        })
    });

    document.querySelectorAll('.delete').forEach(function (element) {
        element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            var form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                // If confirmed, submit the corresponding form
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
// });

</script>
@endpush
