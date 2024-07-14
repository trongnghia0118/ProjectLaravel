@extends('layouts.layout_admin')
@section('title','Trang Quảng Lý')
@section('content')
<div class="container">
<h2>Dashboard</h2>
<div class="row">
    <div class="col-md-4">
    <div class="list-group">
  <button type="button" class="list-group-item list-group-item-action active bg-success" aria-current="true">
    DashBoard
  </button>
  <a href="/admin/product" class="list-group-item list-group-item-action">Sản Phẩm</a>
  <a href="/admin/user" class="list-group-item list-group-item-action">User</a>
  <a href="/admin/category" class="list-group-item list-group-item-action">Danh Mục</a>
</div>
    </div>
    <div class="col-md-8">
    <table class="table">
                 <thead>
                    <tr>
                        <th>STT</th>
                        <th class="text-start">Họ Và Tên</th>
                        <th>email</th>
                        <th>Hành Động</th>
                    </tr>
                 </thead>
                 <tbody>
                  @foreach($user as $user)
                    <tr>
                        <td></td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td><button class="btn btn-outline-danger me-3"><i class="bi bi-trash"></i></button>        <button class="btn btn-outline-warning"><i class="bi bi-pencil"></i></button> </td>
                    </tr>
                    @endforeach
                 </tbody>
                </table>
    </div>
</div>
</div>
@endsection