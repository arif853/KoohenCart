
@extends('layouts.admin')
@section('title','Manage Roles')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Manage Roles</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Roles</li>
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
                    <a href="{{url('/dashboard/users/index')}}" class="btn btn-info rounded">Manage Users</a>
                </div>
                <div class="right pull-right">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#roleModal" class="btn btn-success rounded">Add Role</button>
                </div>

            </div>
            <div class="card-body">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$role->name}}</td>

                            <td>
                                @if($role->name =='Super Admin')
                                <form class="deleteForm" action="{{ url('/dashboard/roles/'.$role->id.'/delete') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit d-none"
                                    data-bs-toggle="modal" data-bs-target="#roleUpdateModal" data-role-id="{{ $role->id}}">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-sm font-sm btn-light rounded delete d-none">
                                        <i class="material-icons md-delete_forever"></i> Delete
                                    </a>
                                </form>
                                @else
                                <form class="deleteForm" action="{{ url('/dashboard/roles/'.$role->id.'/delete') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit"
                                    data-bs-toggle="modal" data-bs-target="#roleUpdateModal" data-role-id="{{ $role->id}}">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit"
                                    data-bs-toggle="modal" data-bs-target="#roleUpdateModal" data-role-id="{{ $role->id}}">
                                        <i class="material-icons md-edit"></i> Add Permission 
                                    </a>
                                    <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning">
                                        Add / Edit Role Permission
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

@include('admin.user-role.role.edit')
@include('admin.user-role.role.create')

@endsection
@push('product')
<script>

    // Edit ROle
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var roleId = $(this).data('role-id');
        // console.log(categoryId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var editURL = "{{url('')}}"+ '/dashboard/roles/'+roleId+'/edit';
        // console.log(editURL);

        $.ajax({
            url: editURL,
            method: 'GET',
            data: {
                id: roleId,
            },
            success: function (response) {
                console.log(response);
                $('#role_id').val(response.role.id);
                $('#role_name').val(response.role.name);
            }
        });
    });

    //Store Roles
    $("#roleStoreForm").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const data = new FormData(this);
        // console.log(data);
        $.ajax({
            url: '{{url('/dashboard/roles')}}',
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
                // else{
                //     $.Notification.autoHideNotify('danger', 'top right', 'Danger', res.responseJSON.errors.name[0]);
                //     $("#sliderEditModal").modal('hide');
                // }
            },
            error: function (xhr, textStatus, errorThrown) {
                $.Notification.autoHideNotify('danger', 'top right', 'Danger', xhr.responseJSON.errors.name[0]);
                $("#roleModal").modal('hide');
            }
        })
    });

    //Update Role
    $("#roleUpdateForm").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        var roleId = $('#role_id').val();
        // console.log(roleId);

        $.ajax({
            url: '{{url('dashboard/roles/')}}'+'/'+roleId,
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
</script>
@endpush
