@extends('admin/layout')

@section('container')



    <div class="post d-flex flex-column-fluid" id="kt_post">




        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-body pt-5">
                    <a href="{{ route('generate.purchase.code') }}" class="btn btn-sm btn-primary"  id="kt_toolbar_primary_button"> New Create </a>
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr style="color:#3f4254" class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-300px">Purchase Code</th>
                                <th class="min-w-300px">Product Name</th>
                                <th class="min-w-300px">MarketPlace Name</th>
                                <th class="min-w-300px">Used</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($purchaseCodes as $purchaseCode)
                                <tr>
                                    <td>
                                        <a href="#" class="text-gray-600 text-hover-primary mb-1"
                                            style="color:#3f4254; font-weight: 500;">{{ $purchaseCode->purchase_code }}</a>
                                    </td>
                                    <td>
                                        <a href="#" class="text-gray-600 text-hover-primary mb-1"
                                            style="color:#3f4254; font-weight: 500;">{{ $purchaseCode->product_name }}</a>
                                    </td>
                                    <td>
                                        <a href="#" class="text-gray-600 text-hover-primary mb-1"
                                            style="color:#3f4254; font-weight: 500;">{{ $purchaseCode->marketplace_name }}</a>
                                    </td>
                                    <td>
                                        <a href="#" class="text-gray-600 text-hover-primary mb-1"
                                            style="color:#3f4254; font-weight: 500;">{{ $purchaseCode->used==1 ? 'yes' : 'No' }}</a>
                                    </td>

                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                            data-kt-menu="true">

                                            <div class="menu-item px-3">
                                                <a href="{{ route('delete.purchase.code', $purchaseCode->id) }}" class="menu-link px-3"  data-kt-customer-table-filter="delete_row">Delete</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::Action=-->
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
@endsection
