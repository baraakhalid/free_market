@extends('front.parent')
@section('styles')


<style>
    /* .product-wish{
        font-size: 30px;
        
    } */
    .text-primary:hover {
    color: #a08582 !important;}

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
        @foreach ( $latestproducts as $latestproduct )

        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img  class="img-fluid w-100" src="{{Storage::url($latestproduct->image ?? '')}}" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{$latestproduct->name}}</h6>
                    <div class="d-flex justify-content-center">
                        <h6>{{$latestproduct->price}}</h6><h6 class="text-muted ml-2"><del>{{$latestproduct->price}}</del></h6>

                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    @if (Auth::guard('user')->check())

                    <a  onclick="performCartStore({{$latestproduct->id }} ,{{$latestproduct->price}})"  class="btn btn-sm text-dark p-0">
                        <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    {{-- <a href="" class="btn btn-sm text-dark p-0">{{$latestproduct->vendor->mobile}}</a> --}}
                    <a  onclick="performFavorite({{$latestproduct->id }})"class="product-wish" class="btn btn-sm text-dark p-0" 
                        @if($latestproduct->is_favorite)
                        style= "color: #a08582"
                        hover="color: #fff !important"
                      @endif><i  class="fas fa-heart text-primary mr-1" ></i>
                     
                    </a>
                    @else
                    <a href="{{route('cms.login','user')}}"  > <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>

                    <a href="{{route('cms.login','user')}}"  class="fas fa-heart"></a>
                    @endif 
          
                
             
                </div>
                  
           


               
            </div>
        </div>
        @endforeach
     
    </div> 
   
</div>

    
@endsection
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
<script >
function performCartStore(id ,price ) {
    axios.post('/cms/user/carts',{
          product_id:  id,
          quantity :1,
          price:price,

    })
    .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        // window.location.href = '/rest/index';
    })
    .catch(function (error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
    });
}
</script>
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
