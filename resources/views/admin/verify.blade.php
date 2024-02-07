@extends('admin/layout')

@section('container')
<div class="main-container">
    <h1>Verify Envato Purchase Code <small>uses envato API v3</small></h1>
    <p class="lead">provide purchase code in the input below and get the data.</p>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <form action="{{url('admin/verify-envato-purchase')}}" method="POST" id="verify-envato-purchase">
            @csrf
          <div class="row">
            <div class="col-md-8">
                <input type="text" name="purchase_code" value="" class="form-control" id="input-purchase-code" placeholder="Enter Purchase Code" />
            </div>
            <div class="col-md-4">
              <select name="result_type" id="" class="form-control">
                <option value="">Select Result Display Type</option>
                <option value="list">List</option>
                <option value="table">Table</option>
              </select>
            </div>
          </div>
          <br>
          <input type="submit" value="Verify Purchase" class="btn btn-success">
        </form>

        @if (isset($output_table))
        <div id="show-result">{!! $output_table !!}</div>


        @endif

      </div>
    </div>
</div>

@endsection
