@extends('layouts.layout')

@section('content')
<div class="container">
<h4>Theo Dõi Đơn Hàng</h4>
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
                    <a href="#" target="_blank" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-eye"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{$dsdh ->links()}}
          </div>
        </div>
        </div>
@endsection