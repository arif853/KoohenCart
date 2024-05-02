@extends('layouts.admin')
@section('title','Coupones')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Coupons List</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Coupons</li>
            </ol>
        </nav>
    </div>
    <div>
        <a href="{{route('coupon.create')}}" class="btn btn-primary mt-md-0 mt-2 pull-right">Add New Coupon</a>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <form class="form-inline search-form search-box pull-right">
                    <div class="form-group">
                        <input class="form-control-plaintext" type="search" placeholder="Search..">
                    </div>
                </form>

            </div>

            <div class="card-body">
                <div>
                    <div class="table-responsive table-desi">
                        <table class="all-package coupon-table table table-striped">
                            <thead>
                                <tr>

                                    <th>Title</th>
                                    <th>Code</th>
                                    <th>Discount</th>
                                    <th>Quantity</th>
                                    <th>Expire date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($coupons->isNotEmpty())
                                    @foreach ($coupons as $item)
                                    <tr data-row-id="1">


                                        <td>{{ $item->coupons_title }}</td>

                                        <td>{{ $item->coupons_code }}</td>

                                        <td>
                                            @if ($item->discounts_type=='percent')
                                                {{ $item->percent_value }} %
                                            @else
                                               {{ $item->fixed }}
                                            @endif

                                        </td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->end_date}}</td>

                                        <td class="">
                                            @if ($item->status==1)
                                                <span class="badge rounded-pill alert-success">Active</span>
                                            @else
                                                <span class="badge rounded-pill alert-danger">Inactive</span>
                                            @endif

                                        </td>

                                        <td class="text-end">
                                            <form class="deleteForm" action="{{route('coupon.destroy', ['id' => $item->id])}}" method="post" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('coupon.edit', ['id' => $item->id]) }}" class="btn btn-sm btn-info rounded font-sm mt-3">Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger rounded font-sm mt-15 delete_coupon">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('coupons_type')
<script>
document.querySelectorAll('.delete_coupon').forEach(function (element) {
    element.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        console.log('click');
        // Find the closest form element related to the clicked link
        var form = this.closest('form');
        // console.log(form);
        // Display SweetAlert confirmation
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
