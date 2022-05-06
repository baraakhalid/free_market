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
                        <h3 class="card-title">{{__('cms.create_product')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
            
                    <form id="create-form">
                        @csrf
                            
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" value="{{$product->name}}"  placeholder="{{__('cms.name')}} ">
                            </div>
                            <div class="form-group">
                                <label>{{__('cms.sup_category')}}</label>
                                <select class="form-control" id="sup_category_id">
                                    @foreach ($sup_categories as $sup_category)
                                    <option value="{{$sup_category->id}}" @if($product->sup_category_id == $sup_category->id) selected @endif>{{$sup_category->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label>{{__('cms.vendor')}}</label>
                                <select class="form-control" id="vendor_id">
                                    @foreach ($vendors as $vendor)
                                    <option value="{{$vendor->id}}" @if($product->vendor_id == $vendor->id) selected @endif>{{$vendor->name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                                <div class="form-group">
                                <label for="description">{{__('cms.description')}}</label>
                                <input type="text" class="form-control" id="description"  value="{{$product->description}}"  placeholder="{{__('cms.description')}}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('cms.price')}}</label>
                                <input type="text" class="form-control" id="price"  value="{{$product->price}}"  placeholder="{{__('cms.price')}}">
                            </div>                
                     
                            <div class="form-group">
                                <label for="product_image">product Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="product_image">
                                        <label class="custom-file-label" for="product_image">Choose file</label>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active"  name="active"
                                    @if($product->available) checked @endif>
                                    
                                    <label class="custom-control-label" for="active">{{__('cms.active')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$product->id}}')"
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
<script>
    $(function () { bsCustomFileInput.init() });
</script>
<script>
     function performUpdate(id) {
   
    var formData = new FormData();
        formData.append('name',document.getElementById('name').value);
        formData.append('sup_category_id', document.getElementById('sup_category_id').value);
        // formData.append('vendor_id', document.getElementById('vendor_id').value);
        formData.append('description',document.getElementById('description').value);
        formData.append('active', document.getElementById('active').checked ?1:0);
        formData.append('price', document.getElementById('price').value);

        if(document.getElementById('product_image').files[0] != undefined) {
            formData.append('image',document.getElementById('product_image').files[0]);
        }
        formData.append('_method','PUT');

        axios.post('/cms/admin/products/{{$product->id}}', formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/products';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
   }

</script>
@endsection