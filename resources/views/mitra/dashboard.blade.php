@extends('layouts.mitra')
@section('content')
    <div class="container">
        <h1>Dashboard Mitra</h1>
        <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>

        <div class="row mt-4">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="dashboard-card text-center p-4 shadow-sm">
                    <i class="fas fa-box-open dashboard-icon mb-2" style="font-size: 2rem;"></i>
                    <h3>Produk</h3>
                    <p>Kelola produk-produk pertanian.</p>
                    <a href="{{ url('mitra/produk') }}" class="btn btn-hijau">Kelola Produk</a>
                </div>
            </div>
        </div>
    </div>
@endsection
