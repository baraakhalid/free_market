
@extends('front.parent')
@section('content')
        <!-- Categories Start -->
        <div class="container-fluid pt-5">
            <div class="row px-xl-5 pb-3">
                @foreach ($sup_categories as $sup_category)
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right">{{$sup_category->products_count}}</p>
                        <a href="{{route('front.products',['sup_category_id'=>$sup_category->id])}}" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="{{asset('front/img/cat-1.jpg')}}" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0">{{$sup_category->name}}</h5>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <!-- Categories End -->
@endsection
  