@extends('cms.parent')

@section('title',__('cms.notifications'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.notifications'))
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
                        <h3 class="card-title">{{__('cms.notifications')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('cms.name')}}</th>
                                    <th>{{__('cms.email')}}</th>

                                    <th>{{__('cms.subject')}}</th>
                                    <th>{{__('cms.message')}}</th>
                                    <th>{{__('cms.read_at')}}</th>
                                    <th>{{__('cms.sent_at')}}</th>
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->email}}</td>

                                    <td>{{$contact->subject}}</td>
                                    <td>{{$contact->message}}</td>
                                    <td>{{$contact->created_at->diffForHumans()}}</td>
                                    <td>{{$contact->updated_at->format('Y-m-d H:ia')}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" onclick="confirmDelete('{{$contact->id}}', this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
        axios.delete('/cms/user/cotacts/'+id)
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