<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mesa extends Model
{
    use SoftDeletes;
    
    protected $table = 'mesa';
    protected $primaryKey = 'id_cliente';
    // public $timestamps = false;

    protected $fillable = ['nome_cliente', 'numero_mesa'];

    public function comandas()
    {
        return $this->hasMany(Comanda::class, 'id_cliente');
    }
}
