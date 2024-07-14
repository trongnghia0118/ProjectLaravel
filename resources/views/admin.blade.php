@extends('layouts.layout_admin')
@section('title')
Tổng Quan
@endsection
@section('body')
<div class="d-flex justify-content-between">
  <h3 class="mb-4">Dashboard</h3>
</div>
<div class="row">
  <div class="col-md-3 mb-4">
    <div class="card border-0 rounded-0 bg-primary-subtle text-primary">
      <div class="card-body text-end">
        <div class="display-6 d-flex justify-content-between">
          <i class="fal fa-file-invoice-dollar"></i>
          {{$soDonHang}}
        </div>
        ORDERS
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-4">
    <div class="card border-0 rounded-0 bg-warning-subtle text-warning">
      <div class="card-body text-end">
        <div class="display-6 d-flex justify-content-between">
          <i class="fal fa-boxes"></i>
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
          <i class="fal fa-users"></i>
          {{$soKhachHang}}
        </div>
        CUSTOMERS
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-4">
    <div class="card border-0 rounded-0 bg-success-subtle text-success">
      <div class="card-body text-end">
        <div class="display-6 d-flex justify-content-between">
          <i class="fal fa-chart-line"></i>
          {{number_format($doanhThu)}}
        </div>
        INCOMES
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4 mb-3">
    <div class="card rounded-0 border-0 shadow-sm">
      <div class="card-body">
        <div class="d-flex border-bottom pb-2 justify-content-between">
          <h6 class="mb-0">
            <i class="fal fa-file-invoice-dollar fa-lg"></i>
            Recent Orders
          </h6>
          <small>
            <a href="#" class="text-decoration-none">All Orders</a>
          </small>
        </div>
        @foreach ($dsDH as $dh)
        <div class="d-flex text-body-secondary pt-3">
          <div class="p-2 me-2 bg-{{($dh->status =='success')?'success':(
          ($dh->status=='cancle')?'danger':'warning')}} text-white">
            <i class="fal fa-receipt"></i>
          </div>
          <a href="#" class="py-2 mb-0 small lh-sm border-bottom w-100 text-decoration-none text-body-secondary">
            <strong class="d-flex justify-content-between">
              Đơn #{{$dh->id}}
              <div>
                <span class="badge text-bg-warning">
                  <i class="far fa-box"></i> {{$dh->total_quantity}}
                </span>
                <span class="badge bg-success-subtle text-success"><i class="far fa-money-bill-wave"></i> {{$dh->total_money}}</span>
              </div>
            </strong>
        Đặt bởi <i>{{$dh->user_fullname}}</i> lúc {{$dh->created_at->diffForHumans()}}
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card rounded-0 border-0 shadow-sm">
      <div class="card-body">
        <div class="d-flex border-bottom pb-2 justify-content-between">
          <h6 class="mb-0">
            <i class="fal fa-stars fa-lg"></i>
            Recent Ratings
          </h6>
          <small>
            <a href="#" class="text-decoration-none">All Ratings</a>
          </small>
        </div>
        @foreach ($dsBL as $bl)
        <div class="d-flex text-body-secondary pt-3">
          <i class="far fa-comment-alt-smile"></i>
          <a href="#" class="py-2 mb-0 small lh-sm border-bottom w-100 text-decoration-none text-body-secondary">
            <strong class="d-flex justify-content-between">
              {{$bl->product->name}}
              <div class="text-warning">
                @for ($i = 0; $i < floor($bl->rating); $i++)
                <i class="bi bi-star-fill"></i>
                @endfor
                @for ($i = 0; $i < 5 - floor($bl->rating); $i++)
                <i class="bi bi-star"></i>
                @endfor
              </div>
            </strong>
            {{$bl->content}}
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-3">
    <div class="card rounded-0 border-0 shadow-sm">
      <div class="card-body">
        <div class="d-flex border-bottom pb-2 justify-content-between">
          <h6 class="mb-0">
            <i class="fal fa-chart-pie fa-lg"></i>
            Statistics</h6>
        </div>


        <div id="curve_chart" style="width:100%;height: 300px"></div>
        
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Month/Year', 'Incomes'],
        @foreach($tkDoanhThu as $tk)
        ['{{$tk->month}}/{{$tk->year}}', {{$tk->total}}],
        @endforeach
      ]);

      var options = {
        title: 'Company Performance',
        curveType: 'function',
        legend: { position: 'bottom' }
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);
    }
  </script>
@endsection