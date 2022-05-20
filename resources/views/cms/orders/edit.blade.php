@extends('cms.parent')
@section('title','Temp')
@section('page-lg','Temp')
@section('main-pg-md','CMS')
@section('page-md','Temp')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.edit_user')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                      
                        

                            <div class="form-group">
                                <label>{{__('cms.status')}}</label>
                                <select class="form-control" id="status">
                                    <option value="Waitting"  @if($order->status == 'Waitting') selected @endif>{{__('cms.Waitting')}}</option>
                                    <option value="Processing" @if($order->status == 'Processing') selected @endif>{{__('cms.Processing')}}</option>
                                    <option value="Delivered" @if($order->status == 'Delivered') selected @endif>{{__('cms.Delivered')}}</option>

                                </select>
                            </div>
                     
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$order->id}}')"
                                class="btn btn-primary">{{__('cms.save')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
{{-- <script src="{{asset('js/axios.js')}}"></script> --}}
{{-- <script>
    $(function () { bsCustomFileInput.init() });
</script> --}}
<script>
    function performUpdate(id) {
        axios.put('/cms/admin/order/{{$order->id}}', {
          
            status: document.getElementById('status').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/order';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection

