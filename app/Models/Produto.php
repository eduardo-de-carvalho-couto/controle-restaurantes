<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    
    protected $table = 'produto';
    protected $primaryKey = 'cod_prod';
    // public $timestamps = false;

    protected $fillable = ['nome_prod', 'valor_prod'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'cod_prod');
    }
}
