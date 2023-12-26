<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    // Khai báo bảng 
    protected $table = 'wards';
    protected $primaryKey = 'code';
    public $incrementing = false;

    public function districts(){
        return $this->belongsTo(Province::class,'district_code','code');
    }
}
