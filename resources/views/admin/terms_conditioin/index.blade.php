@extends('layouts.admin')
@section('title', 'Manage Terms & Conditions')
@section('content')

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Manage Terms & Conditions</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ '/dashborad' }}">Dashborad</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
                </ol>
            </nav>
        </div>

    </div>
    <style>
        .table tr td {
            vertical-align: middle;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    <table id="" class="table table-bordered table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width=30%;">Title</th>
                                <th style="width=60%;">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td >{{ $terms_conditioin->title ?? 'edit title' }}</td>
                                <td >{!! $terms_conditioin->description ?? 'No description available' !!}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-sm font-sm rounded btn-warning edit" data-bs-toggle="modal"
                            data-bs-target="#termscondition" data-aboutus-id="{{ $terms_conditioin->id ?? '' }}">
                            <i class="material-icons md-edit"></i> Edit
                        </a>
                    </div>

                </div> <!-- card-body end// -->
            </div> <!-- card end// -->
        </div>
       

    </div>


    <!-- Modal -->
    <div class="modal fade" id="termscondition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Terms & Condition</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="category_form" id="category_form"></div> --}}
                <form action="{{ route('terms_conditioin.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row g-3">
                            <div class="col-md-12 mb-2">
                                <label for="aboutusTitle" class="form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Type a Title" value="{{ $terms_conditioin->title ?? '' }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="summernote" class="form-label">Description<span
                                        class="text-danger">*</span></label>
                                <textarea placeholder="Type here" class="form-control description" id="summernote" rows="15" name="description">{!! $terms_conditioin->description ?? 'No description available' !!}</textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                                {{-- <button class="btn btn-primary" type="submit">Submit form</button> --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('product')
    <script>
        // Edit ads
    </script>
@endpush
