@extends('layouts.layout')

@section('content')
<div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Single Product</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="index.html">Shop</a></li>
                        <li>Single Product</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Item Details -->
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img img-fluid">
                                    <img src="{{asset('/')}}img/products/{{$sp->image}}" id="current" style="width: 400px; height: 500px ;" alt="#">
                                </div>
                                <div class="images">
                                    <img src="{{asset('/')}}img/products/{{$sp->image}}" class="img" alt="#">
                                    <img src="{{asset('/')}}img/products/{{$sp->image}}" class="img" alt="#">
                                    <img src="{{asset('/')}}img/products/{{$sp->image}}" class="img" alt="#">
                                    <img src="{{asset('/')}}img/products/{{$sp->image}}" class="img" alt="#">
                                    <img src="{{asset('/')}}img/products/{{$sp->image}}" class="img" alt="#">
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{$sp->name}}</h2>
                            <p class="category"><i class="lni lni-tag"></i> Drones:<a href="javascript:void(0)">{{$sp->category->name}}</a></p>
                            <h3 class="price text-primary">{{number_format($sp->sale_price)}}đ<span>{{number_format($sp->price)}}đ</span></h3>
                            <p class="info-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                            <div class="row align-items-end">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group quantity">
                                        <label for="color">Quantity</label>
                                        <input type="number" class="form-control form-control-lg" value="1" min="1" max="{{$sp->instock}}" ng-model="quantity">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12">
                                        <div class="button cart-button">
                                            <button ng-click="addToCart({{$sp->id}}, quantity)"class="btn" style="width: 100%;">Add to Cart</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-info">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="single-block give-review">
                            <h4>4.5 (Overall)</h4>
                            <ul>
                                <li>
                                    <span>5 stars - 38</span>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </li>
                                <li>
                                    <span>4 stars - 10</span>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </li>
                                <li>
                                    <span>3 stars - 3</span>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </li>
                                <li>
                                    <span>2 stars - 1</span>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </li>
                                <li>
                                    <span>1 star - 0</span>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </li>
                            </ul>
                            @auth
                            <!-- Button trigger modal -->
                            <button type="button" class="btn review-btn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Leave a Review
                            </button>
                            @endauth
                            @guest
                            <div class="alert alert-warning">Bạn Cần <a href="{{route('register')}}">Đăng Nhập</a> Để Đánh Giá!</div>
                            @endguest
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="single-block">
                            <div class="reviews">
                                <h4 class="title">Latest Reviews</h4>
                                <!-- Start Single Review -->
                                <div ng-repeat="bl in dsBL" class="single-review">
                                    <img src="assets/images/blog/comment1.jpg" alt="#">
                                    <div class="review-info">
                                        <h4>@{{bl.user_fullname}}
                                            <span>@{{bl.created_at | date:'dd/MM/yyyy HH:mm:ss'}}
                                            </span>
                                        </h4>
                                        <ul class="stars">
                                        <li ng-show="bl.rating>=1"><i class="bi bi-star-fill text-warning"></i></li>
                                        <li ng-show="bl.rating>=2"><i class="bi bi-star-fill text-warning"></i></li>
                                        <li ng-show="bl.rating>=3"><i class="bi bi-star-fill text-warning"></i></li>
                                        <li ng-show="bl.rating>=4"><i class="bi bi-star-fill text-warning"></i></li>
                                        <li ng-show="bl.rating==5"><i class="bi bi-star-fill text-warning"></i></li>
                                        <li ng-show="bl.rating<5"><i class="bi bi-star "></i></li>
                                        <li ng-show="bl.rating<4"><i class="bi bi-star "></i></li>
                                        <li ng-show="bl.rating<3"><i class="bi bi-star "></i></li>
                                        <li ng-show="bl.rating<2"><i class="bi bi-star "></i></li>
                                        <li ng-show="bl.rating<1"><i class="bi bi-star "></i></li>

                                        </ul>
                                        <p>@{{bl.content}}</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Item Details -->

    <!-- Review Modal -->
    <div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="review-rating">Rating</label>
                                <select ng-model="rating"class="form-control" id="review-rating">
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review-message">Review</label>
                        <textarea class="form-control" id="review-message" ng-model='content' rows="8" required></textarea>
                    </div>
                </div>
                <div class="modal-footer button">
                    <button ng-click="sendComment()"type="button" class="btn">Submit Review</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('viewFunction')
<script>
  viewFunction = function($scope, $http){
    $scope.quantity = 1;
    $scope.dsBL = [];
    $scope.getComment = function(){
        $http.get('/api/comments/product/{{$sp->id}}').then(
        function(res){
            $scope.dsBL = res.data.data;
            console.log($scope.dsBL);
        },
        function(res){

        }
    );    
    }
    $scope.getComment();
    $scope.sendComment = function(){
        $http.post('/api/comments',{
            'product_id': {{$sp->id}},
            'content': $scope.content,
            'rating': $scope.rating,
        }).then(
            function(res){
                document.querySelector('.btn-close').click();
                $scope.content='';
                $scope.rating=5;
                $scope.getComment();
            }
        )
    }
    
  }
</script>
@endsection
@section('scripts')
<!-- Các tệp script JavaScript -->
@endsection