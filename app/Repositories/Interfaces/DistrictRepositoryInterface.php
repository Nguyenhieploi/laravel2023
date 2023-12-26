<?php
namespace App\Repositories\Interfaces;

/**
 * Interface DistrictServiceInterface
 * @package App\Services\Interfaces
 */
interface DistrictRepositoryInterface
{
//  Đại diện cho file ProvinRepository.php , phải khai báo tất cả method ở đây
    public function all();
    public function findDistrictByProvinceId(int $province_id);
}
