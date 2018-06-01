<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apostas extends Model
{
	protected $table = 'apostas';
    protected $primaryKey = 'id';
    protected $fillable = ['escore1','escore2'];

    static public function relacoes()
    {
        return ['jogo']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Jogos'];
    }

    public function jogo()
    {
        return $this->belongsTo('App\Models\Jogos','jogo_id');
    }
}
