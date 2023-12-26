<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    // Khai báo bảng 
    protected $table = 'districts';
    protected $primaryKey = 'code';
    public $incrementing = false;


    // cho biết rằng mỗi đối tượng của model hiện tại thuộc về một đối tượng cụ thể của model "Province" dựa trên khóa ngoại "province_code".
    public function provinces(){
        return $this->belongsTo(Province::class,'province_code','code');
    }
    public function wards(){
        return $this->hasMany(Ward::class,'district_code','code');
    }
}
