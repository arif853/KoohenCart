@extends('layouts.admin')
@section('title','Customer Queries')
@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Customer Queries</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Customer Queries</li>
            </ol>
        </nav>
    </div>
</div>
<style>
    .btn-sm i {
        font-size: 16px;
        line-height: 0.7;
        vertical-align: bottom;
    }
</style>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table id="" class="table table-striped table-bordered table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email </th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th width=15%>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $key => $message)
                        <tr>
                            <td>{{$key + 1}}. </td>
                            <td>{{$message->name}}</td>
                            <td>{{$message->email}}</td>
                            <td>
                               {{$message->phone}}
                            </td>
                            <td>
                                {{$message->subject}}
                             </td>
                             <td>
                                {{$message->message}}
                             </td>
                            <td>
                                <form class="deleteForm" action="{{route('webmessage.destroy',['id'=> $message->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand reply"
                                    data-bs-toggle="modal" data-bs-target="#messageReply" data-message-id="{{ $message->id}}">
                                        <i class="material-icons md-reply "></i> Reply
                                    </a>
                                    <a href="#" class="btn btn-sm font-sm btn-danger rounded delete">
                                        <i class="material-icons md-delete_forever"></i> Delete
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </div>
</div>
@include('admin.websetting.replymodal')
@endsection

@push('brand')
<script>

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
