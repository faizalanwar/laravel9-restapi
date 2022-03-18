<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    use SoftDeletes; 
    protected $table = 'mahasiswa';
    protected $fiilable = [
        'username',
        'address'
    ];
    protected $hidden = [] ;
 }
