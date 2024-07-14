@extends('layouts.layout')
@section('title','TNKA NEWS')
@section('content')
<div class="container">
  <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/banner.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/slider_1.webp" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/slider_2.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  @if (Session::has('message'))
                        <div class="alert alert-danger">
                            {{Session::get('message')}}
                        </div>
                        @php
                        Session::forget('message');
                        @endphp
                        @endif
  <div class="container">
    <h2 class="text-center my-5">Sản Phẩm Hot</h2>
    <div class="row">
      @foreach($dsSP as $sp)
      <div class="col-md-3 mt-3">
        <div class="card" style="width: 18rem;">
         <a href="{{route('detail',['slug'=>$sp->slug])}}"> <img src="{{asset('/')}}img/products/{{$sp->image}}" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <h5 class="card-title">{{$sp->name}}</h5>
            @for ($i = 0; $i < floor($sp->rating); $i++)
            <i class="bi bi-star-fill text-warning"></i>
            @endfor
            @for ($i = 0; $i < 5-floor($sp->rating); $i++)
            <i class="bi bi-star"></i>
            @endfor
            <p><span>{{number_format($sp->rating,1)}} Reviews</span></p>
            @if (isset($sp->sale_price))
            <span class="card-text">{{number_format($sp->sale_price)}}đ</span>
            <del class="card-text">{{number_format($sp->price)}}đ</del>
            @else
            <span class="card-text">{{number_format($sp->price)}}đ</span>
            @endif
              
          
            <a href="javascript:void(0)" ng-click="addToCart({{$sp->id}}, 1)" class="btn btn-primary">Mua</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <hr>

    <h2 class="text-center my-5">Sản Phẩm Hot</h2>
    <div class="row">
      @foreach($dsSP as $sp)
      <div class="col-md-3 mt-3">
        <div class="card" style="width: 18rem;">
         <a href="{{route('detail',['slug'=>$sp->slug])}}"> <img src="{{asset('/')}}img/products/{{$sp->image}}" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <h5 class="card-title">{{$sp->name}}</h5>
            @for ($i = 0; $i < floor($sp->rating); $i++)
            <i class="bi bi-star-fill text-warning"></i>
            @endfor
            @for ($i = 0; $i < 5-floor($sp->rating); $i++)
            <i class="bi bi-star"></i>
            @endfor
            <p><span>{{number_format($sp->rating,1)}} Reviews</span></p>
            @if (isset($sp->sale_price))
            <span class="card-text">{{number_format($sp->sale_price)}}đ</span>
            <del class="card-text">{{number_format($sp->price)}}đ</del>
            @else
            <span class="card-text">{{number_format($sp->price)}}đ</span>
            @endif
              
          
            <a href="javascript:void(0)" ng-click="addToCart({{$sp->id}}, 1)" class="btn btn-primary">Mua</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!-- Các tệp script JavaScript -->
@endsection