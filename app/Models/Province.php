<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    // Khai báo bảng 
    protected $table = 'provinces';
    protected $primaryKey = 'code';
    public $incrementing = false;


 //   Phương thức này xác định mối quan hệ "has-many" giữa Province và District. 
 //Nó trả về tất cả các Districts thuộc về Province cụ thể thông qua khóa ngoại "province_code".
    public function districts(){
        return $this->hasMany(District::class, 'province_code','code');
    }

}
