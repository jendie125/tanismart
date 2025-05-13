<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarModel extends Model
{
    protected $table = "komentar";
    protected $primaryKey = "idkomentar";

    public $timestamps = false;
    // fillable
    protected $fillable = [
        'idkomentar',
        'idartikel',
        'iduser',
        'isi',
        'tanggal',
        'balasan'
    ];

    public function artikel()
    {
        return $this->belongsTo(ArtikelModel::class, 'idartikel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
