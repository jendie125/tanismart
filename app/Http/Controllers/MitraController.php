<?php

namespace App\Http\Controllers;

use App\Models\KomentarModel;
use App\Models\ProdukdetailModel;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{

    // dashboard
    public function dashboard()
    {
        return view('mitra.dashboard');
    }

    // produk
    public function produk()
    {
        $data['produk'] = ProdukModel::with(['produkdetail'])->orderBy('idproduk', 'DESC')->paginate(5);
        return view('mitra.produk', $data);
    }

    public function produksimpan(Request $request)
    {
        $request->validate([
            'namaproduk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp,gif,svg',
            'namavariasi' => 'required|array',
            'namavariasi.*' => 'required|string|max:255',
            'hargavariasi' => 'required|array',
            'hargavariasi.*' => 'required|numeric|min:0',
            'stokvariasi' => 'required|array',
            'stokvariasi.*' => 'required|integer|min:0',
        ]);

        // Simpan gambar
        $filename = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
        }

        // Simpan ke tabel produk
        $produk = ProdukModel::create([
            'namaproduk' => $request->namaproduk,
            'deskripsi' => $request->deskripsi,
            'gambar' => $filename,
        ]);

        // Simpan variasi produk ke tabel produkdetail
        foreach ($request->namavariasi as $i => $nama) {
            ProdukdetailModel::create([
                'idproduk' => $produk->idproduk,
                'namavariasi' => $nama,
                'harga' => $request->hargavariasi[$i],
                'stok' => $request->stokvariasi[$i],
            ]);
        }

        return redirect('mitra/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function produkedit($idproduk)
    {
        $data['produkedit'] = ProdukModel::with(['produkdetail'])->find($idproduk);
        $data['produk'] = ProdukModel::with(['produkdetail'])->orderBy('idproduk', 'DESC')->paginate(5);
        return view('mitra.produkedit', $data);
    }

    public function produkupdate(Request $request, $id)
    {
        $request->validate([
            'namaproduk' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg,gif',
            'namavariasi.*' => 'required|string',
            'harga.*' => 'required|numeric|min:0',
            'stok.*' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request, $id) {

            $produk = ProdukModel::findOrFail($id);
            $produk->namaproduk = $request->namaproduk;
            $produk->deskripsi = $request->deskripsi;

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $produk->gambar = $filename;
            }

            $produk->save();

            // Hapus variasi lama
            ProdukDetailModel::where('idproduk', $id)->delete();

            // Tambah variasi baru
            foreach ($request->namavariasi as $i => $nama) {
                ProdukDetailModel::create([
                    'idproduk' => $id,
                    'namavariasi' => $nama,
                    'harga' => $request->harga[$i],
                    'stok' => $request->stok[$i],
                ]);
            }
        });

        return redirect('mitra/produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function produkhapus($idproduk)
    {
        $produk = ProdukModel::find($idproduk);

        if ($produk->gambar && file_exists(public_path('uploads/' . $produk->gambar))) {
            unlink(public_path('uploads/' . $produk->gambar));
        }

        ProdukModel::where('idproduk', $idproduk)->delete();
        ProdukdetailModel::where('idproduk', $idproduk)->delete();
        return redirect('mitra/produk')->with('success', 'produk berhasil dihapus');
    }
}
