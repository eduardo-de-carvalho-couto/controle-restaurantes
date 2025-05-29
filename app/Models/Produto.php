<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'PRODUTO';
    protected $primaryKey = 'cod_prod';
    public $timestamps = false;

    protected $fillable = ['nome_prod', 'valor_prod'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'cod_prod');
    }
}
