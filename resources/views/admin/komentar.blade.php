@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="dashboard-card">
            <h3><i class="fas fa-comments me-2"></i>Kelola Komentar</h3>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($komentar->count())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Pesan</th>
                                <th>Tanggal Dikirim</th>
                                <th>Tindakan</th>
                                <th>Balasan Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($komentar as $key => $k)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $k->user->name }}</td>
                                    <td>{{ Str::limit($k->isi, 50) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y H:i') }}</td>
                                    <td>
                                        <form action="{{ url('admin/komentarhapus', $k->idkomentar) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                    <td>
                                        @if ($k->balasan)
                                            <span class="text-success">{{ $k->balasan }}</span>
                                        @else
                                            <form action="{{ url('admin/komentarbalas') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="idkomentar" value="{{ $k->idkomentar }}">
                                                <textarea name="balasan" rows="2" class="form-control form-control-sm" placeholder="Balas komentar..."></textarea>
                                                <button type="submit" class="btn btn-success btn-sm mt-1">Balas</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    {{ $komentar->links('vendor.pagination.bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-info">Tidak ada komentar yang ditemukan.</div>
            @endif
        </div>
    </div>
@endsection
