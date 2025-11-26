<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    
    protected $table = 'facturas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'cliente_id',
        'fecha',
        'total',
        'estado',
        'registrado_por',
    ];

    public function calcularTotal()
    {
        $total = $this->detallesFactura->sum('subtotal');
        $this->total = $total;
        $this->save();
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class, 'factura_id');
    }

    public function carteraCliente()
    {
        return $this->hasOne(CarteraCliente::class, 'factura_id');
    }
    
    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_id');
    }

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'pago_id');
    }

    

}
