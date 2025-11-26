<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;
    
    protected $table = 'detalle_facturas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'factura_id',
        'producto_id',
        'cantidad_producto',
        'precio_unitario', // Añadido
        'subtotal', // Añadido
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}