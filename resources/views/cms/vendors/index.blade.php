@extends('cms.parent')

@section('title',__('cms.vendors'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.vendors'))
@section('page-sm',__('cms.index'))

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.vendors')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.name')}}</th>
                                    <th>{{__('cms.permissions')}}</th>                            

                                    <th>{{__('cms.mobile')}}</th>
                                    <th>{{__('cms.telephone')}}</th>
                                    <th>{{__('cms.address')}}</th>
                                    <th>{{__('cms.email')}}</th>
                                    <th>{{__('cms.city')}}</th>
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.updated_at')}}</th>
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $vendor)

                                <tr>
                                    <td>{{$vendor->id}}</td>
                                    <td>{{$vendor->name}}</td>
                                    <td>
                                        <a href="{{route('vendor.edit-permissions',$vendor->id)}}"
                                            class="btn btn-app bg-info">
                                            <i class="fas fa-envelope"></i> {{$vendor->permissions_count}}
                                        </a>
                                    </td>
                                    <td>{{$vendor->mobile}}</td>
                                    <td>{{$vendor->telephone}}</td>
                                    <td>{{$vendor->address}}</td>
                                    <td>{{$vendor->email}}</td>  
                                    <td>{{$vendor->city->name}}</td>                            
                          
                                    <td>{{$vendor->created_at}}</td>
                                    <td>{{$vendor->updated_at}}</td>
                                    <td>
                                        @canany('Update-vendor','Delete-vedor')

                                        <div class="btn-group">
                                           @can('Update-vendor')
                                            <a href="{{route('vendors.edit', $vendor->id )}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                          @endcan
                                          @can('Delete-vendor')

                                            <a href="#" onclick="confirmDelete('{{$vendor->id}}', this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                           @endcan
                                        </div>
                                        @endcanany
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id, reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id, reference);
        }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/cms/admin/vendors/'+id)
        .then(function (response) {
            console.log(response);
            // toastr.success(response.data.message);
            reference.closest('tr').remove();
            showMessage(response.data);
        })
        .catch(function (error) {
            console.log(error.response);
            // toastr.error(error.response.data.message);
            showMessage(error.response.data);
        });
    }

    function showMessage(data) {
        Swal.fire(
            data.title,
            data.text,
            data.icon
        );
    }
</script>
@endsection