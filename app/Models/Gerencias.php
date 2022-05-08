<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gerencias extends Model
{
    use HasFactory;

    protected $table = 'gerencias';

    protected $fillable = [
        'nombre_gerencia',
        'status',
        //nombramos a los campos que se pueden llenar y estamos enviando
    ];

    public function getRouteKeyName()
    {
        return 'uuid'; //USAREMOS EL UUID COMO IDENTIFICADOR DE RUTA
    }

    protected static function boot()
    {//metodo para que cuando cree un registro se ejecute y asigne un uuid automaticamente
        parent::boot();
        static::creating(function($model){
            // $model->uuid = Str::uuid()->toString();
            $model->uuid =  (string) Str::uuid().round(microtime(true) * 1000);
        });
    }

    //relacion uno a muchos
    public function unidades(){
        return $this->hasMany(Unidades::class, 'gerencia_id');
    }

    //relacion uno a muchos
    public function pei_objetivos_especificos(){
        return $this->hasMany(PeiObjetivosEspecificos::class, 'gerencia_id');
    }
}
