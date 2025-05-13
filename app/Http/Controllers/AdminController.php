<?php

namespace App\Http\Controllers;

use App\Models\ArtikelModel;
use App\Models\KomentarModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // artikel
    public function artikel()
    {
        $data['artikel'] = ArtikelModel::orderBy('idartikel', 'DESC')->paginate(5);
        return view('admin.artikel', $data);
    }

    public function artikelsimpan(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'sumber' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg,gif,webp,svg',
            'url' => 'required',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'sumber' => $request->sumber,
            'tanggal' => date('Y-m-d H:i:s'),
            'url' => $request->url,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads');
            $file->move($path, $filename);
            $data['gambar'] = $filename;
        }

        ArtikelModel::create($data);
        return redirect('admin/artikel')->with('success', 'Artikel berhasil disimpan');
    }

    public function artikeledit($idartikel)
    {
        $data['artikeledit'] = ArtikelModel::find($idartikel);
        $data['artikel'] = ArtikelModel::orderBy('idartikel', 'DESC')->paginate(5);
        return view('admin.artikeledit', $data);
    }

    public function artikelupdate(Request $request, $idartikel)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'sumber' => 'required',
            'gambar' => 'nullable|mimes:png,jpg,jpeg,gif,webp,svg',
            'url' => 'required',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'sumber' => $request->sumber,
            'tanggal' => date('Y-m-d H:i:s'),
            'url' => $request->url,
        ];

        $artikel = ArtikelModel::find($idartikel);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar && file_exists(public_path('uploads/' . $artikel->gambar))) {
                unlink(public_path('uploads/' . $artikel->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads');
            $file->move($path, $filename);
            $data['gambar'] = $filename;
        }

        ArtikelModel::where('idartikel', $idartikel)->update($data);
        return redirect('admin/artikel')->with('success', 'Artikel berhasil diperbarui');
    }

    public function artikelhapus($idartikel)
    {
        $artikel = ArtikelModel::find($idartikel);

        if ($artikel->gambar && file_exists(public_path('uploads/' . $artikel->gambar))) {
            unlink(public_path('uploads/' . $artikel->gambar));
        }

        ArtikelModel::where('idartikel', $idartikel)->delete();
        return redirect('admin/artikel')->with('success', 'Artikel berhasil dihapus');
    }

    // komentar
    public function komentar()
    {
        $data['komentar'] = KomentarModel::with(['user'])->orderBy('idkomentar', 'DESC')->paginate(5);
        return view('admin.komentar', $data);
    }

    public function komentarbalas(Request $request)
    {
        $request->validate([
            'idkomentar' => 'required',
            'balasan' => 'required',
        ]);

        KomentarModel::where('idkomentar', $request->idkomentar)->update([
            'balasan' => $request->balasan,
        ]);

        return redirect('admin/komentar')->with('success', 'Komentar berhasil dibalas');
    }

    public function komentarhapus($idkomentar)
    {
        KomentarModel::where('idkomentar', $idkomentar)->delete();
        return redirect('admin/komentar')->with('success', 'Komentar berhasil dihapus');
    }
}
