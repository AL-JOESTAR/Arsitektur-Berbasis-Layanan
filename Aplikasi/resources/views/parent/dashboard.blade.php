@extends('layouts_dashboard.parent')

@section('konten')

<div class="container">

<div class="card shadow-sm mb-4">

<div class="card-body">

<h3>

Selamat Datang

{{ $parent->nama }}

</h3>

@if($user)

<h5>

Anak :

{{ $user->name }}

</h5>

@endif

</div>

</div>

<div class="card shadow-sm">

<div class="card-header">

Riwayat Keluar Masuk

</div>

<div class="card-body">

<table class="table">

<thead>

<tr>

<th>No</th>

<th>Reader</th>

<th>Waktu</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($logs as $log)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $log['reader']['reader_name'] }}</td>

<td>{{ $log['scan_time'] }}</td>

<td>

@if($log['access_result']=="allow")

<span class="badge bg-success">

Allow

</span>

@else

<span class="badge bg-danger">

Deny

</span>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<form method="POST" action="{{ route('parent.logout') }}">

@csrf

<button class="btn btn-danger mt-3">

Logout

</button>

</form>

</div>

@endsection