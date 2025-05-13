@extends('layouts.home')
@section('content')
    <div class="container article-container">

        <br>
        <article>
            <header class="article-header">
                <h1 class="article-title">{{ $artikel->judul }}</h1>
                <div class="article-meta">Dipublikasikan pada:
                    {{ \Carbon\Carbon::parse($artikel->tanggal)->format('d M Y') }}</div>
            </header>

            <div class="article-featured-image">
                <img src="{{ asset('uploads/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}">
            </div>

            <div class="article-content">{!! nl2br(e($artikel->konten)) !!}</div>

            @if ($artikel->sumber && $artikel->url)
                <div class="article-meta mt-3">
                    <p>Sumber: <a href="{{ $artikel->url }}" target="_blank"
                            style="color: #007bff;">{{ $artikel->sumber }}</a></p>
                </div>
            @endif
        </article>

        <!-- Artikel Lainnya -->
        <div class="other-articles mt-5">
            <h3 class="mb-3">Artikel Lainnya</h3>
            <div class="row">
                @foreach ($artikellain as $item)
                    <div class="col-md-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ url('artikeldetail/' . $item->idartikel) }}" class="text-decoration-none">
                                    {{ $item->judul }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> 
        </div>

        <!-- Komentar -->
        <div class="mt-5">
            <h3>Komentar</h3>
            @forelse ($artikel->komentar as $komentar)
                <div class="komentar mb-4">
                    <strong>{{ $komentar->nama ?? 'Pengunjung' }}</strong>
                    <span class="text-muted d-block mb-2">
                        {{ \Carbon\Carbon::parse($komentar->tanggal)->format('d M Y H:i') }}
                    </span>
                    <p>{{ $komentar->isi }}</p>

                    @if (!empty($komentar->balasan))
                        <div class="balasan-admin ms-4 p-3 border rounded">
                            <strong>Admin</strong>
                            <span class="text-muted d-block mb-2">
                                {{ \Carbon\Carbon::parse($komentar->tanggal)->format('d M Y H:i') }}
                            </span>
                            <p>{{ $komentar->balasan }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-muted">Belum ada komentar.</p>
            @endforelse
        </div>

        <!-- Form Komentar -->
        <div class="comment-form mt-4">
            <h3 class="mb-3">Tinggalkan Komentar:</h3>
            <form action="{{ url('komentarsimpan') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="isi" class="form-label">Komentar:</label>
                    <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>
                </div>
                <input type="hidden" name="idartikel" value="{{ $artikel->idartikel }}">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
@endsection
