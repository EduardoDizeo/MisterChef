<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'telefono',
        'correo_electronico',
        'direccion',
        'estado',
        'registrado_por',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function facturasCompra()
    {
        return $this->hasMany(Compra::class, 'proveedor_id');
    }
}
