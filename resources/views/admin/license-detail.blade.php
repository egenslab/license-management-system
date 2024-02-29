@extends('admin/layout')


@section('container')
    {{-- FIlter Options --}}
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">License Details </h1>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-3">
                                     <h4>Buyer Information</h4>
                                     <p>
                                        @if ( $license->name)
                                        <b>Name:</b> {{ $license->name }} <br>
                                        @endif
                                        <b>Email:</b> {{ $license->email }}
                                    </p>
                                </div>
                                <div class="col-sm-5">
                                    <h4>Product Information</h4>
                                    <p>
                                       @if ( $license->name)
                                       <b>Item Nam:</b> {{ isset($response['item']['name'])? $response['item']['name'] :  $license->script_name }} <br>
                                       @endif
                                       <b>license Type:</b> {{ isset($response['license'])? $response['license']  :  "Regular License" }}
                                       <br>
                                       <b>Sold Date:</b> {{ isset($response['sold_at'])? $response['sold_at']  :  "" }}
                                       <br>
                                       <b>Supported Until:</b> {{ isset($response['supported_until'])? $response['supported_until']  :  "" }}
                                       <br>
                                       <b>License key:</b> {{ $license->license_key }}
                                       <br>
                                       <b>Active Date:</b> {{ $license->created_at}}
                                       <br>
                                       <b>Website:</b> <a href=" {{ $license->website_url}}" target="_blank"> {{ $license->website_url}}</a>
                                   </p>

                                </div>
                                <div class="col-sm-4">

                                    <h4>Server Information</h4>

                                     <p>
                                        @if ( $ipDetails)
                                        <b>Ip Adress:</b> {{ isset($ipDetails['query'] )? $ipDetails['query']  : ""}} <br>
                                        @endif
                                     </p>



                                </div>
                            </div>












                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
