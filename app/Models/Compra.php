<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'proveedor_id',
        'fecha_compra',
        'total_compra',
        'estado',
        'registrado_por',
    ];

    // Relación con proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    // Relación con usuario (registrado_por)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }

    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id');
    }

    public function carteraProveedor()
    {
        return $this->hasOne(CarteraProveedor::class, 'compra_id');
    }
}