@extends('front.parent')
@section('styles')


<style>
    .product-wish{
        font-size: 30px;
        
    }
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
            <h2 class="section-title px-5"><span class="px-2">Products</span></h2>
        </div>
    
        <div class="row px-xl-5 pb-3">
            @foreach ( $products as $product )

            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img  class="img-fluid w-100" src="{{Storage::url($product->image ?? '')}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$product->name}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{$product->price}}</h6><h6 class="text-muted ml-2"><del>{{$product->price}}</del></h6>

                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0">{{$product->vendor->mobile}}</a>
                        @if (Auth::guard('user')->check())
                        <form>
                        <input onclick="performFavorite({{$product->id }})" type="button" class="btn btn-danger" value="Add To WishList" 
                         @if($product->is_favorite)
                              style= "color: #a08582"
                              hover="color: #a08582 !important"
                            @endif
                        >
                        </form>
                        {{-- <input onclick="performFavoriteStore({{$product->id }})"  > <a href="#"  class="product-wish" class="btn btn-sm text-dark p-0"><i  class="fas fa-heart text-primary mr-1"
                             @if($product->is_favorite)
                              style= "color: #a08582"
                              hover="color: #a08582 !important"
                              @endif
                            ></i></a> --}}
                        @else
                        <a href="{{route('cms.login','user')}}"  class="fas fa-heart"></a>
                        @endif
                    </div>
                      
                 {{-- <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0">{{$product->vendor->mobile}}</a>

                     @foreach ($products as $product )

                     @if (Auth::guard('user')->check())
                     <a href="#" class="product-wish" class="btn btn-sm text-dark p-0" onclick="performFavorite({{$product->id}})" class="fas fa-heart"
                        @if($product->is_favorite)
                        style="background : var(--green)";
                        color: #fff;
                        @endif
                    >
                     </a>
                     @else<a href="{{route('cms.login','user')}}" class="fas fa-heart"></a>
                     @endif

                         
                     @endforeach --}}


                   
                </div>
            </div>
            @endforeach
         
        </div> 
       
    </div>

@endsection
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
<script>
function performFavorite(id) {
    axios.post ('/cms/user/favorites',{
        product_id:id ,
    })
    .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
      
    })
    .catch(function (error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
    });
}


</script>
