<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarteraCliente extends Model
{
    use HasFactory;

    protected $table = 'cartera_clientes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'factura_id',
        'saldo_pendiente',
        'estado',
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
