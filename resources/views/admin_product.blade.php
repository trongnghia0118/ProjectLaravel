@extends('layouts.layout_admin')
@section('title','Product')
@section('body')
<div class="d-flex justify-content-between">
          <h3 class="mb-4">Products</h3>
          <div>
            <a href="#" class="btn btn-outline-success rounded-0">Manage Categories</a>
            <a href="{{route('admin.product.add')}}" class="btn btn-primary rounded-0">Add Product</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-primary-subtle text-primary">
              <div class="card-body text-end">
                <div class="display-6 d-flex justify-content-between">
                  <i class="fal fa-box"></i>
                  {{$soSanPham}}
                </div>
                PRODUCTS
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-danger-subtle text-danger">
              <div class="card-body text-end">
                <div class="display-6 d-flex justify-content-between">
                <i class="fa-solid fa-box-open"></i>
                  {{$soSapHet}}
                </div>
                RUNNING OUT
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-success-subtle text-success">
              <div class="card-body text-end">
                <div class="display-6 d-flex justify-content-between">
                  <i class="fal fa-boxes"></i>
                  {{$SoDanhMuc}}
                </div>
                CATEGORIES
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-dark-subtle text-dark">
              <div class="card-body text-end">
                <div class="display-6 d-flex justify-content-between">
                  <i class="fal fa-archive"></i>
                  {{$trash}}
                </div>
                ARCHIVE
              </div>
            </div>
          </div>
        </div>
        
        <div class="card rounded-0 border-0 shadow-sm">
          <div class="card-body">
            <table class="table text-center">
              <thead>
                <tr>
                  <th class="text-start" colspan="2">Product</th>
                  <th>Price</th>
                  <th>Instock</th>
                  <th>Rating</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                @foreach($dsSP as $sp)
                <tr>
                  <td style="width:64px">
                    <img src="{{asset('/')}}img/products/{{$sp->image}}" class="w-100">
                  </td>
                  <td class="text-start">
                    <strong>
                      {{$sp->name}}
                    </strong>
                    <br>
                    <small>
                      Id: <strong>{{$sp->id}}</strong> | 
                      Category: <a href="#" class="text-decoration-none fw-bold">{{$sp->category->name}}</a> 
                    </small>
                  </td>
                  <td c>
                    @if(is_null($sp->sale_price))
                    {{number_format($sp->price)}} đ
                    @else
                    {{number_format($sp->sale_price)}} đ
                    <br><del>{{number_format($sp->price)}}</del> đ
                    @endif
                  </td>
                  <td>
                  {{$sp->instock}}
                  </td>
                  <td>
                    {{$sp->rating}}<br>
                    @for($i = 0; $i < floor($sp->rating); $i++)
                    <i class="fas fa-star fa-xs text-warning"></i>
                    @endfor
                    @for($i = 0; $i < 5 - floor($sp->rating); $i++)
                    <i class="far fa-star fa-xs text-warning"></i>
                    @endfor
                  </td>
                  <td>
                    <a href="{{route('admin.product.update', $sp->id)}}" class="btn btn-outline-warning btn-sm">
                      <i class="fas fa-pencil fa-fw"></i>
                    </a>
                    <form action="{{ route('admin.product.delete', $sp->id) }}" method="post">
                      @csrf
                      <input type="hidden" value='3'>
                      <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-times fa-fw"></i></button>
                      <a href="{{ route('admin.product.delete', $sp->id) }}" >
                      
                    </a>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{$dsSP ->links()}}
          </div>
        </div>
@endsection