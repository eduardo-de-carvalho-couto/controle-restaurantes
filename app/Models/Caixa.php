<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    protected $table = 'caixa';
    protected $primaryKey = 'id_transacao';
    public $timestamps = false;

    protected $fillable = ['tipo_transacao', 'valor_transacao', 'id_pagamento', 'data_transacao'];

    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class, 'id_pagamento');
    }
}
