@extends('admin/layout')

@section('container')
    {{-- FIlter Options --}}
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true">

                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Product List </h1>

            </div>

            <div class="d-flex align-items-center py-1">

                <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary"  >Create</a>

            </div>
            <!--end::Actions-->
        </div>
    </div>



   <div class="container">
     <div class="row">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr style="color:#3f4254" class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-300px">Name</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">

                                @foreach ($products  as $product)
                                <tr>
                                    <td> {{ $product->name }}</td>
                                </tr>

                                @endforeach


                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
            </div>
        </div>
     </div>

   </div>
@endsection
