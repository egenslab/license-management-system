@extends('admin/layout')


@php

    // Function to generate a UUID
    function generateUUID()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
    }

    // Generate a UUID
    generateUUID();

@endphp

@section('container')
    {{-- FIlter Options --}}
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Generate License Key </h1>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card">
                        <div class="card-body ">
                            <form action="{{ route('store.purchase.code') }}" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-sm-3"> <b>License Code</b></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="purchase_code" value="{{ generateUUID() }}"
                                            class="form-control" />

                                        @error('purchase_code')
                                            <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mt-5">
                                    <label class="col-sm-3"> <b>Product Name</b></label>
                                    <div class="col-sm-9">
                                        <select name="product_name" class="form-control">
                                            <option selected disabled>Select Product </option>

                                            @foreach ($products as $product)
                                                <option value="{{ $product->name }}">{{ $product->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('product_name')
                                            <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-5">
                                    <label class="col-sm-3"> <b>Marketplace Name</b></label>
                                    <div class="col-sm-9">

                                        <select name="marketplace_name" class="form-control">
                                            <option selected disabled>Select Marketplace </option>
                                            <option value="Egens Theme">Egens Theme</option>
                                            <option value="Egens Lab">Egens Lab</option>
                                            <option value="Other">Other</option>

                                        </select>
                                        @error('marketplace_name')
                                            <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mt-10">
                                    <div class="col-sm-9 offset-3">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
