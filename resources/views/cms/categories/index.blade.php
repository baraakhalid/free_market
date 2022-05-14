@extends('cms.parent')

@section('title',__('cms.categories'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.categories'))
@section('page-md',__('cms.index'))

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.categories')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.image')}}</th>
                                    <th>{{__('cms.name')}}</th>
                                    <th>{{__('cms.subcategories')}}</th>


                                    <th>{{__('cms.active')}}</th>

                                    {{-- <th>{{__('cms.description')}}</th> --}}
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.updated_at')}}</th>
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>
                                        <img height="80" src="{{Storage::url($category->image ?? '')}}" />
                                    </td>
                                 
                                    <td>{{$category->name}}</td>
                                    {{-- <td>{{$category->supcategories_count}}</td> --}}
                                    <td><span class="badge bg-info">{{$category->supcategories_count}}</span>
                                    </td>
                                     <td><span class="badge @if($category->active) bg-success @else bg-danger @endif">{{$category->active_status}}</span>
                                    </td>

                                    {{-- <td>{{$category->description}}</td> --}}
                                    <td>{{$category->created_at}}</td>
                                    <td>{{$category->updated_at}}</td>
                                    <td>
                                        @canany('Update-Category','Delete-Category')
                                        <div class="btn-group">
                                            @can('Update-Category')

                                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('Delete-Category')
                                            <a href="#" onclick="confirmDelete('{{$category->id}}', this)"
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
        axios.delete('/cms/admin/categories/'+id)
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