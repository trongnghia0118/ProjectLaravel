@extends('layouts.layout')

@section('content')
    <div class="content">
        <h1>Tin mới nhất</h1>
        @php
            foreach ($tinmoi as $tin) {
                echo "<p>{$tin->tieuDe}</p>";
                echo "<em> Ngày đăng: {$tin->ngayDang} </em>";
                echo "<hr>";
            }
        @endphp

    </div>
@endsection
