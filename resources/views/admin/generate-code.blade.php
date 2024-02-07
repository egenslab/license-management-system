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
    <div class="container">
        <h1>Purchase Code Generate </h1>
        <div class="row mt-15">
            <div class="col-sm-11">
                <form action="{{ route('store.purchase.code') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group row">
                                <label class="col-sm-3"> <b>Purchase Code</b></label>
                                <div class="col-sm-9">
                                    <input type="text" name="purchase_code" value="{{ generateUUID() }}"
                                        class="form-control" id="input-purchase-code" placeholder="Enter Purchase Code" />

                                        @error('purchase_code')
                                        <div class="error text-danger">{{ $message }}</div>
                                       @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label class="col-sm-3"><b>Marketplace Name</b></label>
                                <div class="col-sm-9">
                                    <select name="marketplace_name" class="form-control">
                                        <option selected disabled>Select Marketplace </option>
                                        <option value="Egens Theme">Egens Theme</option>

                                    </select>

                                    @error('marketplace_name')
                                     <div class="error text-danger">{{ $message }}</div>
                                   @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="Generate" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
@endsection
