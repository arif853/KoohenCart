@extends('layouts.admin')
@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Website Settings</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ '/dashborad' }}">Dashborad</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                </div>

                <div class="card-body">
                    <form action="{{ route('order.bulk_order.curier') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row g-3">
                            <div class="col-md-12 mb-2">
                                <label for="primary_mobile_no" class="form-label">Invoice Number<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="invoice_no" name="invoice_no"
                                    value="{{ $order->invoice_no }}">
                            </div>
                            <input type="hidden" name="id" value="{{ $order->id }}" />
                            <div class="col-md-12 mb-2">
                                <label for="recipient_name" class="form-label">Recipient Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="recipient_name" name="recipient_name"
                                    value="{{ $order->customer->firstName }} {{ $order->customer->lastName }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="recipient_address" class="form-label">Recipient Address</label>
                                <input type="text" class="form-control" id="recipient_address" name="recipient_address"
                                    value="{{ isset($order->shipping->shipping_add) ? $order->shipping->shipping_add : (isset($order->customer->billing_address) ? $order->customer->billing_address : '') }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="recipient_phone" class="form-label">Recipient Phone Number</label>
                                <input type="text" class="form-control" id="recipient_phone" name="recipient_phone"
                                    value="{{ isset($order->shipping->s_phone) ? $order->shipping->s_phone : (isset($order->customer->phone) ? $order->customer->phone : '') }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="cod_amount" class="form-label">CoD Amount</label>
                                <input type="text" class="form-control" id="cod_amount" name="cod_amount"
                                    value="{{ isset($order->delivery_charge) ? $order->delivery_charge : 80 }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="slider_image" class="form-label">Note<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="note" name="note">{{ $order->comment }}</textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
