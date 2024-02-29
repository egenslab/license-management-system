@extends('admin/layout')

@section('container')
    {{-- FIlter Options --}}
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Product Add </h1>
            </div>
        </div>
    </div>



   <div class="container">
     <div class="row">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-body ">
                        <form action="{{ route('product.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3"> <b>Product Name</b></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name"  class="form-control" placeholder="Enter Your Project Name" />

                                        @error('name')
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
