<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
	protected $table = 'times';
    protected $primaryKey = 'id';
    protected $fillable = ['nome','sigla','foto'];

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }
}
