<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    use SoftDeletes;
    
    protected $table = 'pagamento';
    protected $primaryKey = 'id_pagamento';
    public $timestamps = false;

    protected $fillable = ['id_comanda', 'data_pagamento', 'forma_pagamento'];

    public function comanda()
    {
        return $this->belongsTo(Comanda::class, 'id_comanda');
    }

    public function caixa()
    {
        return $this->hasOne(Caixa::class, 'id_pagamento');
    }
}
