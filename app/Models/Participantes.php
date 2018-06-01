<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{
	protected $table = 'participantes';
    protected $primaryKey = 'id';
    protected $fillable = ['nome'];

    static public function relacoes()
    {
        return ['aposta']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Apostas'];
    }

    public function aposta()
    {
        return $this->hasMany('App\Models\Apostas','participante_id');
    }
}
