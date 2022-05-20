@extends('cms.parent')

@section('title',__('cms.orders'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.orders'))
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
                        <h3 class="card-title">{{__('cms.orders')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.Order Date')}}</th>   
                                    <th  >{{__('cms.Status')}}</th>  
                               

                                    <th  >{{__('cms.Total')}}</th>                            
                          
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.updated_at')}}</th>
                            
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>Order{{$loop->index+1}}</td>
                                   
                                    <td>{{$order->date}}</td>
                                    <td><span class="status text-success">&bull;</span> {{$order->status}}</td>

                                    <td>{{$order->total}}$</td>
                                    
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->updated_at}}</td>
                                   
                                    <td>
                                        <div class="btn-group">
                                            {{-- @can('Update-Order') --}}

                                            <a href="{{route('order.edit',$order->id)}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- @endcan --}}

                                            {{-- @can('Delete-Order') --}}
                                            <a href="#" onclick="confirmDelete('{{$order->id}}', this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            {{-- @endcan --}}
                                        </div>
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
        axios.delete('/cms/user/orders/'+id)
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
 function updateOrderStatus(id){
   
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