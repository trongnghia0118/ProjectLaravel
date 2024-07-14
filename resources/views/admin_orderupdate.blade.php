@extends('layouts.layout_admin')
@section('title','Product')
@section('body')
<div class="d-flex justify-content-between">
          <h3 class="mb-4">OrderView</h3>
          <h3 class="mb-4">Order</h3>
        </div>
        <div class="row">
          <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-primary-subtle text-primary">
              <div class="card-body text-end">
                <div class="display-6 d-flex justify-content-between">
                  <i class="fal fa-box"></i>
                 
                </div>
                Success
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-danger-subtle text-danger">
              <div class="card-body text-end">
                <div class="display-6 d-flex justify-content-between">
                <i class="fa-solid fa-box-open"></i>
               
                </div>
                Shipping
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-success-subtle text-success">
              <div class="card-body text-end">
                <div class="display-6 d-flex justify-content-between">
                  <i class="fal fa-boxes"></i>
                  
                </div>
                Pending
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-dark-subtle text-dark">
              <div class="card-body text-end">
                <div class="display-6 d-flex justify-content-between">
                  <i class="fal fa-archive"></i>
                  
                </div>
                Cancle
              </div>
            </div>
          </div>
        </div>
        
        <div class="card rounded-0 border-0 shadow-sm">
          <div class="card-body">
            <form action="" method="post">
              @csrf
            <table class="table text-center">
              <thead>
                <tr>
                  <th class="text-start" >Order</th>
                  <th>UserName</th>
                  <th>Name Product</th>
                  <th>Price</th>
                  <th>QuanTiTy</th>
                  <th>Status</th>
                  <th>Xác Nhận</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                <tr>
                  <td class="text-start">
                    <strong>
                    TNKA:{{$donhang->order->id}}
                    </strong>
                    <br>
                    <small>
                      ID: <strong>{{$donhang->order->id}}</strong> 
                      
                    </small>
                  </td>
                  <td c>
                  {{$donhang->order->user_fullname}}
                  </td>
                  <td>
                    @foreach($donhang2 as $dh)
                  {{$dh->product->name}} <br>
                  @endforeach
                  </td>
                  <td c>
                  {{number_format($donhang->total_money)}}
                  </td>
                  <td>
                    {{$donhang->total_quantity}}
                  </td>
                  <td>
                  <select class="form-select form-select-lg mb-3" aria-label="Large select example" name='status'>
                  <option selected value="{{$donhang->status}}">{{$donhang->status}}</option>
                  <option value="pending">pending</option>
                  <option value="cancle">cancle</option>
                  <option value="shipping">shipping</option>
                  <option value="success">success</option>
                  </select>
                  </td>
                  <td><button class='btn btn-outline-info' type='submit'>Xác Nhận</button></td>
                  <td>
                    <a href="#" target="_blank" class="btn btn-primary btn-sm">
                      <i class="fas fa-eye fa-fw"></i>
                    </a>
                    <a href="{{route('admin.order.update', $donhang->order_id)}}" class="btn btn-outline-warning btn-sm">
                      <i class="fas fa-pencil fa-fw"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
            </form>
          </div>
        </div>
@endsection