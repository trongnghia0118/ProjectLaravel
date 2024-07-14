@extends('layouts.layout_admin')
@section('title','Product')
@section('body')
@if(Session::has('success_message'))
    <div class="alert alert-success">
        {{ Session::get('success_message') }}
    </div>
@endif
<div class="d-flex justify-content-between">
          <h3 class="mb-4">Order</h3>
        </div>
        <div class="row">
          <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-primary-subtle text-primary">
              <div class="card-body text-end">
                <div class="display-6 d-flex justify-content-between">
                  <i class="fal fa-box"></i>
                  {{$dssc}}
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
                {{$dssh}}
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
                  {{$dsod}}
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
                  {{$dsca}}
                </div>
                Cancle
              </div>
            </div>
          </div>
        </div>
        
        <div class="card rounded-0 border-0 shadow-sm">
          <div class="card-body">
            <table class="table text-center">
              <thead>
                <tr>
                  <th class="text-start" >Order</th>
                  <th>Price</th>
                  <th>Instock</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                @foreach($dsdh as $od)
                <tr>
                  <td class="text-start">
                    <strong>
                      {{$od->user_fullname}}
                    </strong>
                    <br>
                    <small>
                      Id: <strong>{{$od->id}}</strong> | 
                      
                    </small>
                  </td>
                  <td c>
                  {{number_format($od->total_money)}}
                  </td>
                  <td>
                  {{$od->total_quantity}}
                  </td>
                  <td>
                    {{$od->status}}
                  </td>
                  <td>
                    <a href="{{route('admin.order.views', $od->id)}}" target="_blank" class="btn btn-primary btn-sm">
                      <i class="fas fa-eye fa-fw"></i>
                    </a>
                    <a href="{{route('admin.order.update', $od->id)}}" class="btn btn-outline-warning btn-sm">
                      <i class="fas fa-pencil fa-fw"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{$dsdh ->links()}}
          </div>
        </div>
@endsection