<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_barang', 'jumlah', 'harga', 'tanggal_penjualan'];

}
