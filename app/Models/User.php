<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'registrado_por');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'registrado_por');
    }

    public function clientesRegistrados()
    {
        return $this->hasMany(Cliente::class, 'registrado_por');
    }

    public function proveedoresRegistrados()
    {
        return $this->hasMany(Proveedor::class, 'registrado_por');
    }

    public function productosRegistrados()
    {
        return $this->hasMany(Producto::class, 'registrado_por');
    }

}
