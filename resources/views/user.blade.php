@extends('layouts.layout')
@section('title', 'Đăng Nhập/Đăng Ký')
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
 <h2>Đăng Nhập/Đăng Ký</h2>
 <hr>
 @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
 <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-6 mb-5">
                <div class="contact-form bg-light p-30">
                    <h3 class="mb-4">Đăng Ký</h3>
                    <form action=''method='post'>
                        <div class="control-group mb-3">
                            @csrf
                            <input type="text" class="form-control" id="name" placeholder="Họ Và Tên" name='name' required>
                        </div>
                        <div class="control-group mb-3">
                            <input type="text" class="form-control" id="email" placeholder="Email" name='email'
                                required>
                        </div>
                        <div class="control-group mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Nhập Mật Khẩu" name='pass' required>
                        </div>
                        <div class="control-group mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Xác Nhận Lại Mật Khẩu" name='repass'required>
                        </div>
                        
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Đăng Ký</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="contact-form bg-light p-30">
                    <h3 class="mb-4">Đăng Nhập</h3>
                    <form action="/login" method='post'>
                        @csrf
                        <div class="control-group mb-3">
                            <input type="text" class="form-control" id="email" placeholder="Nhập Email" name='email'
                                required>
                        </div>
                        <div class="control-group mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Nhập Password" name='pass' required>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name='remember'>
                       <label class="form-check-label" for="flexCheckDefault">
                      Remember Me
                      </label>
                      </div>
                     
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Đăng Nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Các tệp script JavaScript -->
@endsection