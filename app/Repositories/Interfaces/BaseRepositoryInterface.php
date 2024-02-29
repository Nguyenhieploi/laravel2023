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
    public function create(array $payload);
    public function update(int $id = 0, array $payload = []);
    public function delete(int $id= 0 );
    public function pagination(
        array $column = ['*'],
        array $condition = [], // Mảng chứa điều kiện tìm kiếm cho câu lệnh WHERE.
        array $join=[], //Mảng chứa thông tin nối bảng (nếu có).
        array $extend = [],
        int $perPage=1,
        array $relations = [] 
    );
    public function updateByWhereIn(string $whereInField = '', array $whereIn =  [],array $payload = []);
}
