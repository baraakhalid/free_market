@extends('cms.parent')

@section('title','Cities')
@section('page-lg','Index')
@section('main-pg-md','Cities')
@section('page-md','Index')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.cities')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.name')}}</th>
                                    {{-- <th>{{__('cms.users')}}</th> --}}
                                    {{-- <th>{{__('cms.active')}}</th> --}}
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.updated_at')}}</th>
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $city)
                                <tr>
                                    <td>{{$city->id}}</td>
                                    <td>{{$city->name}}</td>
                                  
                                    {{-- <td><span class="badge bg-success">{{$city->users_count}}</span></td> --}}
                                    {{-- <td><span class="badge @if($city->active) bg-success @else bg-danger @endif">{{$city->active_status}}</span>
                                    </td> --}}
                                    {{-- <td><span class="badge bg-success">{{$city->active}}</span></td> --}}
                                    <td>{{$city->created_at}}</td>
                                    <td>{{$city->updated_at}}</td>
                                    <td>
                                        @canany('Update-City','Delete-City')

                                        <div class="btn-group">
                                            @can('Update-City')
                                            <a href="{{route('cities.edit',$city->id)}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('Delete-City')

                                            <form method="POST" action="{{route('cities.destroy', $city->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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

@endsection