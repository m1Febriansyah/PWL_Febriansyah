<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level';        // Mendefinisikan nama tabel
    protected $primaryKey = 'level_id';  // Mendefinisikan primary key

    protected $fillable = ['level_kode', 'level_nama'];
}
