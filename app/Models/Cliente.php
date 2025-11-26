<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'telefono',
        'direccion',
        'nit',
        'correo_electronico',
        'estado',
        'registrado_por',
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'cliente_id');
    }

}
