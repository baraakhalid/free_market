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
                        <h3 class="card-title">{{__('cms.create_sup_category')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
            
                    <form id="create-form">
                        @csrf
                            
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.name')}}">
                            </div>
                            <div class="form-group">
                                <label>{{__('cms.category')}}</label>
                                <select class="form-control" id="category_id">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active" name="active">
                                    <label class="custom-control-label" for="active">{{__('cms.active')}}</label>
                                </div>
                            </div>
                        
                            {{-- <div class="form-group">
                                <label for="description">{{__('cms.description')}}</label>
                                <input type="text" class="form-control" id="description" placeholder="{{__('cms.description')}}">
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="sup_category_image">sup_category Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="sup_category_image">
                                        <label class="custom-file-label" for="sup_category_image">Choose file</label>
                                    </div>
                                
                                </div>
                            </div> --}}
                        </div>
                    </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performStore()"
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
     function performStore() {
       
       axios.post('/cms/admin/sup_categories', {
           name: document.getElementById('name').value,
           active: document.getElementById('active').checked,
           category_id: document.getElementById('category_id').value,




           // role_id: document.getElementById('role_id').value,
       })
       .then(function (response) {
           console.log(response);
           toastr.success(response.data.message);
           document.getElementById('create-form').reset();
       })
       .catch(function (error) {
           console.log(error.response);
           toastr.error(error.response.data.message);
       });
   }
    // function performStore() {
    //     var formData = new FormData();
    //     formData.append('name', document.getElementById('name').value);
    //     formData.append('description', document.getElementById('description').value);
    //     formData.append('image',document.getElementById('sup_category_image').files[0]);

    //     axios.post('/cms/admin/categories',formData)
    //     .then(function (response) {
    //         console.log(response);
    //         toastr.success(response.data.message);
    //         document.getElementById('create-sup_category').reset();
    //     })
    //     .catch(function (error) {
    //         console.log(error.response);
    //         toastr.error(error.response.data.message);
    //     });
    // }
</script>
@endsection