<?php
namespace App\Repositories\Interfaces;

/**
 * Interface BaseServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
//  Đại diện cho file ProvinRepository.php , phải khai báo tất cả method ở đây
    public function all();
    public function findById(int $id);
}
