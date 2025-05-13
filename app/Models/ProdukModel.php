<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    protected $table = "produk";
    protected $primaryKey = "idproduk";

    public $timestamps = false;
    // fillable
    protected $fillable = [
        'namaproduk',
        'deskripsi',
        'variasi',
        'stok',
        'harga',
        'gambar'
    ];

    public function produkdetail()
    {
        return $this->hasMany(ProdukdetailModel::class, 'idproduk');
    }
}
