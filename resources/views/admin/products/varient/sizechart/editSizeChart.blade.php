@extends('layouts.admin')
@section('title','Update Size Chart')
@section('content')
<div class="container">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h1>Edit Size Chart for {{ $category->category_name }}</h1>

                <form action="{{ route('size_chart.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" id="category" class="form-control" disabled>
                            <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                        </select>
                    </div>

                    <div class="form-group mb-4 mt-2">
                        <label for="headers">Headers</label>
                        <div id="header-container">
                            <button type="button" id="add-header" class="btn btn-secondary mb-2">+</button>
                            @foreach($categoryHeaders[$category->id] as $headerId => $headerName)
                                <div class="header-input-group mb-2">
                                    <input type="text" name="headers[{{ $headerId }}]" class="form-control d-inline-block w-25 mr-2" value="{{ $headerName }}">
                                    <button type="button" class="btn btn-danger btn-sm remove-header">Remove</button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr id="header-row">
                                <th>Size</th>
                                @foreach($categoryHeaders[$category->id] as $header)
                                    <th>{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody id="size-chart-body">
                            @foreach($sizes as $size)
                                <tr data-size-id="{{ $size->id }}">
                                    <td>{{ $size->size_name }}</td>
                                    <input type="hidden" name="size_id[]" id="size_id_{{ $size->id }}" value="{{ $size->id }}">
                                    @foreach($categoryHeaders[$category->id] as $headerId => $header)
                                        <td>
                                            <input type="text" name="values[{{ $size->id }}][{{ $headerId }}]" class="form-control" value="{{ $sizeChartData[$size->size_name][$header] ?? '' }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const headerContainer = document.getElementById('header-container');
            const headerRow = document.getElementById('header-row');
            const sizeChartBody = document.getElementById('size-chart-body');
            let headerCount = {{ count($categoryHeaders[$category->id]) }};

            document.getElementById('add-header').addEventListener('click', function () {
                const headerDiv = document.createElement('div');
                headerDiv.classList.add('header-input-group', 'mb-2');

                const headerInput = document.createElement('input');
                headerInput.type = 'text';
                headerInput.name = `headers[new_${headerCount}]`;
                headerInput.classList.add('form-control', 'd-inline-block', 'w-25', 'mr-2');
                headerInput.placeholder = 'Header';

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-header');
                removeButton.textContent = 'Remove';

                headerDiv.appendChild(headerInput);
                headerDiv.appendChild(removeButton);
                headerContainer.insertBefore(headerDiv, this);

                const th = document.createElement('th');
                th.textContent = headerInput.placeholder;
                th.id = `header-th-new_${headerCount}`;
                headerRow.appendChild(th);

                headerInput.addEventListener('input', function () {
                    th.textContent = headerInput.value;
                });

                const sizes = @json($sizes);
                sizes.forEach(size => {
                    const td = document.createElement('td');
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = `values[${size.id}][new_${headerCount}]`;
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
                if (event.target && event.target.classList.contains('remove-header')) {
                    const headerDiv = event.target.closest('.header-input-group');
                    const headerInput = headerDiv.querySelector('input');
                    const headerId = headerInput.name.match(/\d+/)[0];
                    document.getElementById(`header-th-new_${headerId}`).remove();
                    headerDiv.remove();

                    const sizeChartRows = document.querySelectorAll('#size-chart-body tr');
                    sizeChartRows.forEach(row => {
                        const inputTd = row.querySelector(`td:nth-child(${parseInt(headerId) + 2})`); // +2 because of Size column and 0-based index
                        if (inputTd) {
                            inputTd.remove();
                        }
                    });
                }
            });
        });
    </script>
</div>
@endsection
