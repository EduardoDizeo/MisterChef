<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoProveedor extends Model
{
    use HasFactory;

    protected $table = 'pagos_proveedores';

    protected $fillable = [
        'compra_id',
        'proveedor_id',
        'monto_pago',
        'fecha_pago',
        'metodo_pago',
        'registrado_por',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }
}
