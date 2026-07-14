@extends('layouts_dashboard.master')


@section('konten')
    <h2>kelola laporan</h2>

    <div class="container mt-4">

<h2>Daftar Laporan</h2>

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>

<th>Kamar</th>

<th>Deskripsi</th>

<th>Waktu</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($laporans as $laporan)

<tr>

<td>{{ $loop->iteration }}</td>

<td>

{{ $laporan['penyewaan']['kamar']['Nomor_Kamar'] }}

</td>

<td>

{{ $laporan['deskripsi'] }}

</td>

<td>

{{ $laporan['waktu_laporan'] }}

</td>

<td>

{{ ucfirst($laporan['status_laporan']) }}

</td>

<td>

<form

action="/admin/laporan/{{ $laporan['id'] }}"

method="POST"

>

@csrf

<select

name="status_laporan"

class="form-select mb-2"

>

<option

value="menunggu"

{{ $laporan['status_laporan']=='menunggu' ? 'selected' : '' }}

>

Menunggu

</option>

<option

value="diproses"

{{ $laporan['status_laporan']=='diproses' ? 'selected' : '' }}

>

Diproses

</option>

<option

value="selesai"

{{ $laporan['status_laporan']=='selesai' ? 'selected' : '' }}

>

Selesai

</option>

</select>

<button

class="btn btn-primary btn-sm"

>

Update

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>
@endsection