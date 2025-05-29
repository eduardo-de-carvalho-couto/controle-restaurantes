<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';
    protected $primaryKey = 'id_pedido';
    public $timestamps = false;

    protected $fillable = ['id_comanda', 'cod_prod', 'quantidade'];

    public function comanda()
    {
        return $this->belongsTo(Comanda::class, 'id_comanda');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'cod_prod');
    }
}
