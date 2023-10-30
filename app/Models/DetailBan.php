<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailBan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'detail_ban';
    protected $primaryKey = 'id_detail_ban';
    protected $guarded = [];
}
