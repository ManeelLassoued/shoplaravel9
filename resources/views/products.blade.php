@extends('layout')


@section('content')

 <div class="row mb-1">
        @foreach ($products as $product )
      <!-- Product 1 -->
      <div class="col-md-4 custom-col">
            <div class="card h-100">
               <a href=""> 
                <img src="{{asset('assets/image/'.$product->photo.'')}}" class="card-img-top" alt="Product Image" height="210px">
               </a>
                <div class="card-body d-flex flex-column text-center">  
                 <h5 class="card-title fw-bold capitalize">{{ $product->product_name  }}</h5>
                    <p class="card-text small">{{ $product->product_description  }}</p>
                    <p class="card-text fw-bold">Price: <span class="fw-normal">${{ $product->price }}</span></p>
                    <a class="btn btn-primary btn-sm mt-auto mx-auto" href="{{ route('add.to.cart', $product->id)  }}">Add to Cart</a>  
                </div>
     </div>
</div>
   @endforeach
</div>

@endsection