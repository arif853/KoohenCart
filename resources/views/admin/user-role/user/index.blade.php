
@extends('layouts.admin')
@section('title','Manage Users')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Manage Users</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                    <button type="button" data-bs-toggle="modal" data-bs-target="#userModal" class="btn btn-success rounded mr-5 btn-sm">Add User</button>
                    <a href="{{url('/dashboard/roles')}}" class="btn btn-info rounded mr-5 btn-sm">Roles</a>
                    {{-- <a href="#" class="btn btn-info rounded btn-sm">Permission</a> --}}
                </div>
                <div class="right pull-right">
                </div>

            </div>
            <div class="card-body">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email </th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $userrole)
                                    {{-- {{$userrole->name}} --}}
                                    <span class="badge bg-info">{{$userrole}}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if($user->hasRole(['Super Admin']))
                                <form class="deleteForm" action="{{ url('/dashboard/users/'.$user->id.'/delete') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit d-none"
                                    data-bs-toggle="modal" data-bs-target="#userEditModal" data-user-id="{{ $user->id}}">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-sm font-sm btn-light rounded delete d-none">
                                        <i class="material-icons md-delete_forever"></i> Delete
                                    </a>
                                </form>
                                @else
                                <form class="deleteForm" action="{{ url('/dashboard/users/'.$user->id.'/delete') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit"
                                    data-bs-toggle="modal" data-bs-target="#userEditModal" data-user-id="{{ $user->id}}">
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

@include('admin.user-role.user.edit')
@include('admin.user-role.user.create')

@endsection
@push('product')
<script>

    // Edit User
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var userId = $(this).data('user-id');

        $.ajax({
            url: '{{route('users.edit')}}',
            method: 'GET',
            data: {
                id: userId,
            },
            success: function (response) {
                console.log(response);
                $('#user_id').val(response.user.id);
                $('#user_name').val(response.user.name);
                $('#user_email').val(response.user.email);
                $('#edit_user_roles_id option').prop('selected', false);
                $('#edit_user_roles_id').val([]);
                response.user.roles.forEach(function(role) {
                    $('#edit_user_roles_id option[value="' + role.name + '"]').prop('selected', true);
                });
                $('#edit_user_roles_id').trigger('change');
            }
        });
    });

    //Store Users
    $("#userStoreFrom").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const data = new FormData(this);
        $.ajax({
            url: "{{url('dashboard/users/store')}}",
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
                $.Notification.autoHideNotify('danger', 'top right', 'Error', xhr.responseJSON.errors.join('<br>'));
                $("#userModal").modal('hide');
            }
        })
    });

    //Update Category
    $("#userUpdateFrom").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        // var userId =  $('#user_id').val();

        // console.log(userId);
        console.log(data);
        // var updateURL = "{{url('')}}"+ '/dashboard/users/'+userId+'update';
        // console.log(updateURL);

        $.ajax({
            url: '{{route('users.update')}}',
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
                else{
                    $.Notification.autoHideNotify('danger', 'top right', 'Danger', res);

                }
            },
            error: function (xhr, textStatus, errorThrown) {
                $.Notification.autoHideNotify('danger', 'top right', 'Error', xhr.responseJSON.errors.join('<br>'));
                $("#userEditModal").modal('hide');
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
