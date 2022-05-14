@extends('front.parent')
@section('styles')


<style>
    /* .product-wish{
        font-size: 30px;
        
    } */
    /* .text-primary:hover {
    color: #a08582 !important;} */

    .img-fluid  {
        height: 150px;
    }
   
</style>

@endsection
@section('content')
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Favorites Products</span></h2>
        </div>
    
        <div class="row px-xl-5 pb-3">
            @foreach ( $favorites as $favorite )
            {{-- {{$product->vendor->mobile}} --}}

            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img  class="img-fluid w-100" src="{{Storage::url($favorite->image ?? '')}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$favorite->name}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{$favorite->price}}</h6><h6 class="text-muted ml-2"><del>{{$favorite->price}}</del></h6>

                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0">{{$favorite->vendor->mobile}}</a>
{{-- 
                        <a href="{{route('favorites.save',['product_id'=>$favorite->id])}}" class="product-wish" class="btn btn-sm text-dark p-0"><i  class="fas fa-heart text-primary mr-1"
                              style= "color: #0a0909"
                            ></i></a> --}}

                          
                    
                    
                      
                    </div>
                   
                </div>
            </div>
            @endforeach
         
        </div> 
       
    </div>

@endsection
    
