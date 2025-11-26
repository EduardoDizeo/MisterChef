<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarteraProveedor extends Model
{
    use HasFactory;

    protected $table = 'cartera_proveedores';
    protected $primaryKey = 'id';

    protected $fillable = [
        'compra_id', 
        'saldo_pendiente',
        'estado',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }
}