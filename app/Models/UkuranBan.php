<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UkuranBan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ukuran_ban';
    protected $guarded = [];
}
