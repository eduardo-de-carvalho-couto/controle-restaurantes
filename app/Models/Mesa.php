<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = 'MESA';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    protected $fillable = ['nome_cliente', 'numero_mesa'];

    public function comandas()
    {
        return $this->hasMany(Comanda::class, 'id_cliente');
    }
}
