<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comanda extends Model
{
    use SoftDeletes;
    
    protected $table = 'comanda';
    protected $primaryKey = 'id_comanda';
    // public $timestamps = false;

    protected $fillable = ['id_cliente', 'valor_comanda', 'data_comanda'];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_cliente');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_comanda');
    }

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class, 'id_comanda');
    }
}
