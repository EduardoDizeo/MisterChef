<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'proveedor_id',
        'nombre',
        'gramaje',
        'precio_compra',
        'precio_venta',
        'stockActual',
        'stockMinimo',
        'estado',
        'registrado_por',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class, 'producto_id');
    }

    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'producto_id');
    }
}
