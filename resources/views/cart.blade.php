@extends('layouts.layout')

@section('content')
<div class="container">
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../img/banner.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../img/slider_1.webp" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../img/slider_2.jpg" class="d-block w-100" alt="...">
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
    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div ng-if="cart.length>0" class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Price</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                <!-- Cart Single List list -->
                <div ng-repeat="sp in cart" class="cart-single-list">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="/detail/@{{sp.slug}}"><img src="{{asset('/')}}img/products/@{{sp.image}}"
                                    alt="#"></a>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <h5 class="product-name"><a href="/detail/@{{sp.slug}}">
                                    @{{sp.name}}</a></h5>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="count-input">
                                <input type="number" class="form-control form-control-lg" ng-model="sp.quantity"
                                    max='50'min='1'ng-change="updateQuantity(sp.id, sp.quantity)">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <span ng-if="sp.sale_price!=null">
                                <p>@{{sp.sale_price|number}}đ</p>
                                <del>@{{sp.price|number}}đ</del>
                            </span>
                            <span ng-if="sp.sale_price==null">
                                <p>@{{sp.price|number}}đ</p>

                            </span>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>@{{sp.quantity * ((sp.sale_price!=null)?sp.sale_price:sp.price)| number}}đ</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <a class="remove-item" href="javascript:void(0)" ng-click="removeFromCart($index)"><i
                                    class="lni lni-close"></i></a>
                        </div>
                    </div>
                </div>
                <!-- End Single List list -->
            </div>
            <form method="POST" action="" class="row">
                @csrf
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="right checkout-steps-form-style-1">
                                    <h6>Thông Tin Giao Hàng</h6>
                                    <section class="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Full Name</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Full name" name="fullname" value="{{(Auth::check())?Auth::user()->name:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Phone </label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Phone" name="phone" value="{{(Auth::check())?Auth::user()->phone:''}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Email</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Email" name="email" value="{{(Auth::check())?Auth::user()->email:''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Address</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Address" name="address" value="{{(Auth::check())?Auth::user()->address:''}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                            <input type="checkbox" id="agree" name="agree" required>
                                            <label for="agree">
                                                <p>Tôi Đã đọcw và đồng ý tất cả các điều khoản của shop</p>
                                            </label>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Total<span>@{{totalCartMoney()|number}}đ</span></li>
    
                                    </ul>
                                    <div class="button">
                                        <button type="submit" class="btn">Checkout</button>
                                        <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--/ End Total Amount -->
        </div>
    </div>
</div>
<div ng-if="cart.length==0" class="d-flex justify-content-center align-item-center">
    <div class="text-center">
        Giỏ Hàng đang Trống!
        <br>
        <a href="{{route('home')}}" class='btn btn-outline-info'>Tiếp Tục Mua</a>
    </div>

</div>
</div>
<!--/ End Shopping Cart -->
</div>
@endsection
@section('viewFunction')
<script>
    viewFunction = function ($scope, $http) {
        $scope.updateQuantity = function (id, quantity) {
            $http.patch('/api/cart/' + id, {
                quantity: quantity
            }).then(function (res) {

            })
        }
    }
</script>
@endsection
@section('scripts')
<!-- Các tệp script JavaScript -->
@endsection