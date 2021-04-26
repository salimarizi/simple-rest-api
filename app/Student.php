<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
      'nrp',
      'nama',
      'foto',
      'prodi',
      'fakultas',
      'universitas'
    ];
}
