<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogos extends Model
{
	protected $table = 'jogos';
    protected $primaryKey = 'id';
    protected $fillable = ['status','time1','time2','escore1','escore2','data'];

    static public function relacoes()
    {
        return ['time1','time2']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Times','App\Models\Times'];
    }

    public function time1()
    {
        return $this->belongsTo('App\Models\Times','time1');
    }

    public function time2()
    {
        return $this->belongsTo('App\Models\Times','time2');
    }
}
