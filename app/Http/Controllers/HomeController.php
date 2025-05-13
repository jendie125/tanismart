<?php

namespace App\Http\Controllers;

use \Log;
use App\Models\ArtikelModel;
use App\Models\KomentarModel;
use App\Models\ProdukModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['artikel'] = ArtikelModel::orderBy('idartikel', 'DESC')->limit(6)->get();
        $data['produk'] = ProdukModel::with(['produkdetail'])->limit(6)->get(); // ambil 6 produk
        return view('home', $data);
    }

    // artikel
    public function artikeldetail($idartikel)
    {
        $data['artikel'] = ArtikelModel::with('komentar')->findOrFail($idartikel);

        $data['artikellain'] = ArtikelModel::where('idartikel', '!=', $idartikel)
            ->orderBy('idartikel', 'DESC')
            ->take(5)
            ->get();

        return view('artikeldetail', $data);
    }

    public function komentarsimpan(Request $request)
    {
        $request->validate([
            'idartikel' => 'required',
            'isi' => 'required',
        ]);

        KomentarModel::create([
            'idartikel' => $request->idartikel,
            'iduser' => auth()->user()->id,
            'isi' => $request->isi,
            'tanggal' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil disimpan');
    }

    // produk
    public function produkdetail($idproduk)
    {
        $produk = ProdukModel::with('produkdetail')->findOrFail($idproduk);
        $harga_min = $produk->produkdetail->min('harga');
        $harga_max = $produk->produkdetail->max('harga');

        return view('produkdetail', compact('produk', 'harga_min', 'harga_max'));
    }

    public function cartsimpan(Request $request)
    {
        $idproduk = $request->query('id');
        $quantity = (int) $request->query('quantity', 1);
        $variant = $request->query('variant', null);
        $price = (int) $request->query('price', 0);

        $cart = session()->get('cart', []);

        $key = $idproduk . '-' . $variant;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'idproduk' => $idproduk,
                'variant' => $variant,
                'price' => $price,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);

        return redirect('keranjang')->with('success', 'Produk berhasil dimasukkan ke keranjang!');
    }

    public function keranjang()
    {
        $cart = session('cart', []);
        $productIds = array_map(function ($item) {
            return $item['idproduk'];
        }, $cart);

        $produk = ProdukModel::with('produkdetail')->whereIn('idproduk', $productIds)->get();

        $total = $this->calculateTotal($cart);

        // return response()->json($cart);

        return view('keranjang', compact('cart', 'total', 'produk'));
    }



    public function keranjangupdate(Request $request)
    {
        \Log::info('Cart before update: ', session('cart', []));

        $cart = session('cart', []);
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $variant = $request->input('variant');

        foreach ($cart as &$item) {
            if ($item['idproduk'] == $productId && $item['variant'] == $variant) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        // Cek apakah cart berhasil diupdate
        \Log::info('Cart after update: ', $cart);

        session(['cart' => $cart]);

        // return response()->json($cart); 
        return response()->json($this->calculateTotal($cart));
    }

    public function keranjanghapus($id)
    {
        $cart = session('cart', []);
        $cart = array_filter($cart, fn($item) => $item['idproduk'] != $id);
        session(['cart' => $cart]);
        return redirect('keranjang');
    }

    public function keranjangtotal()
    {
        $cart = session('cart', []);
        return number_format($this->calculateTotal($cart), 0, ',', '.');
    }

    private function calculateTotal($cart)
    {
        return array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function checkout()
    {
        $data['cart'] = session('cart', []);
        $productIds = array_map(function ($item) {
            return $item['idproduk'];
        }, $data['cart']);

        $produk = ProdukModel::with('produkdetail')->whereIn('idproduk', $productIds)->get();
        $data['produk'] = $produk;
        return view('checkout', $data);
    }
}
