<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelModel extends Model
{
    protected $table = "artikel";
    protected $primaryKey = "idartikel";

    public $timestamps = false;
    // fillable
    protected $fillable = [
        'judul',
        'konten',
        'gambar',
        'tanggal',
        'url',
        'sumber'
    ];

    public function komentar()
    {
        return $this->hasMany(KomentarModel::class, 'idartikel');
    }
}
