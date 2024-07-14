@extends('layouts.admin')
@section('title','Size Chart')
@section('content')

<style>
    .header-input-container{
        position: relative;
        margin-right: 5px;
    }
    .header-delete {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translate(-40%,-50%);
        color: red
    }
</style>
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
            <div class="card-header">
                <h3>Size Charts</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($categories as $category)
                    <div class="col-lg-6 col-md-6">
                        <div class="header-size-chart d-flex justify-content-between mb-4">
                            <h5>{{ $category->category_name }}</h5>
                            <div>
                                {{-- <a href="{{ route('size_chart.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a> --}}
                                <a href="{{ route('size_chart.destroy', $category->id) }}" class="btn btn-danger btn-sm" onclick="confirmDelete(event)">Delete</a>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    @foreach($categoryHeaders[$category->id] as $header)
                                    <th>{{ $header }}</th>
                                    @endforeach
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


        {{-- <script>
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
        </script> --}}
    </div>
</div>

@endsection
@push('varient')
<script>
    $(document).ready(function () {
        const headerContainer = $('#header-container');
        const headerRow = $('#header-row');
        const sizeChartBody = $('#size-chart-body');
        let headerCount = 0;

        $('#add-header').click(function () {
            const headerDiv = $('<div>', {
                class: 'header-input-container d-inline-block mb-2 mr-2'
            });

            const headerInput = $('<input>', {
                type: 'text',
                name: `headers[${headerCount}]`,
                class: 'form-control d-inline-block header-input',
                placeholder: 'Header'
            }).appendTo(headerDiv);

            const deleteButton = $('<button>', {
                type: 'button',
                text: 'X',
                class: 'btn btn-sm ml-2 header-delete'
            }).appendTo(headerDiv);

            headerDiv.appendTo(headerContainer);

            const th = $('<th>', {
                text: headerInput.attr('placeholder'),
                id: `header-th-${headerCount}`
            }).appendTo(headerRow);

            headerInput.on('input', function () {
                th.text($(this).val());
            });

            deleteButton.click(function () {
                const index = headerInput.attr('name').match(/\d+/)[0];
                th.remove();
                $(`input[name^='values'][name$='[${index}]']`).each(function () {
                    $(this).parent().remove();
                });
                headerDiv.remove();
            });

            const sizes = @json($sizes);
            $.each(sizes, function (index, size) {
                const td = $('<td>');
                const input = $('<input>', {
                    type: 'text',
                    name: `values[${size.id}][${headerCount}]`,
                    class: 'form-control'
                }).appendTo(td);

                const row = sizeChartBody.find(`tr[data-size-id="${size.id}"]`);
                if (row.length) {
                    row.append(td);
                }
            });

            headerCount++;
        });

        $(document).on('click', '.remove-size', function () {
            $(this).closest('tr').remove();
        });
    });


</script>

@endpush
