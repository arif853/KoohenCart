@extends('layouts.admin')
@section('title','Size Chart')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Varient List</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Varient</li>
            </ol>
        </nav>
    </div>
    <div>
        <a href="#" class="btn btn-primary btn-sm rounded"> Create Size Chart</a>
        <!-- Button trigger modal -->

    </div>
</div>
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <h3>Size Charts</h3>
            @foreach($categories as $category)
            <div class="card-body">
                <h5>{{ $category->category_name }}</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Size</th>
                            @foreach($categoryHeaders[$category->id] as $header)
                            <th>{{ $header }}</th>
                            @endforeach
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($sizeChartData[$category->id]))
                        @foreach($sizes as $size)
                            @if(isset($sizeChartData[$category->id][$size->size_name]))
                                <tr>
                                    <td>{{ $size->size_name }}</td>
                                    @foreach($categoryHeaders[$category->id] as $header)
                                    <td>{{ $sizeChartData[$category->id][$size->size_name][$header] ?? '' }}</td>
                                    @endforeach
                                    <td>
                                        <a href="{{ route('size_chart.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <form action="{{ route('size_chart.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

            @endforeach
        </div>
    </div>

    @php
        $categories = DB::table('categories')->get();
        $sizes = DB::table('sizes')->get();
    @endphp
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h1>Create Size Chart</h1>

                <form action="{{ route('size_chart.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4 mt-2">
                        <label for="headers">Headers</label>
                        <div id="header-container">
                            <button type="button" id="add-header" class="btn btn-secondary" style="margin-left: 10px">+</button>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr id="header-row">
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="size-chart-body">
                            @foreach($sizes as $size)
                                <tr data-size-id="{{ $size->id }}">
                                    <td>{{ $size->size_name }}</td>
                                    <input type="hidden" name="size_id[]" id="size_id_{{ $size->id }}" value="{{ $size->id }}">
                                    <td><button type="button" class="btn btn-warning btn-sm remove-size">x</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const headerContainer = document.getElementById('header-container');
                const headerRow = document.getElementById('header-row');
                const sizeChartBody = document.getElementById('size-chart-body');
                let headerCount = 0;

                document.getElementById('add-header').addEventListener('click', function () {
                    const headerInput = document.createElement('input');
                    headerInput.type = 'text';
                    headerInput.name = `headers[${headerCount}]`;
                    headerInput.classList.add('form-control', 'd-inline-block', 'w-25', 'mb-2', 'mr-2');
                    headerInput.placeholder = 'Header';
                    headerContainer.insertBefore(headerInput, this);

                    const th = document.createElement('th');
                    th.textContent = headerInput.placeholder;
                    th.id = `header-th-${headerCount}`;
                    headerRow.appendChild(th);

                    headerInput.addEventListener('input', function () {
                        th.textContent = headerInput.value;
                    });

                    const sizes = @json($sizes);
                    sizes.forEach(size => {
                        const td = document.createElement('td');
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.name = `values[${size.id}][${headerCount}]`;
                        input.classList.add('form-control');
                        td.appendChild(input);
                        const row = sizeChartBody.querySelector(`tr[data-size-id="${size.id}"]`);
                        if (row) {
                            row.appendChild(td);
                        }
                    });

                    headerCount++;
                });

                document.addEventListener('click', function (event) {
                    if (event.target && event.target.classList.contains('remove-size')) {
                        const row = event.target.closest('tr');
                        row.remove();
                    }
                });
            });
        </script>
    </div>
</div>

@endsection
@push('varient')


@endpush
