<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'factura_id',
        'cliente_id',       
        'monto_pago',
        'fecha_pago',
        'metodo_pago',      
        'estado',
        'registrado_por',
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
