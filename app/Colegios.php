<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colegios extends Model
{
    protected $table = 'colegios';
    protected $fillable =['id','col_nombre','col_abreviatura','col_sie','col_foto',
                            'col_estado','col_observacion','col_sysuser'];
}
