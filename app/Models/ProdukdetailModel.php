<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukdetailModel extends Model
{
    protected $table = "produkdetail";
    protected $primaryKey = "idprodukdetail";

    public $timestamps = false;
    // fillable
    protected $fillable = [
        'idproduk',
        'namavariasi',
        'harga',
        'stok',
    ];

    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'idproduk');
    }
}
