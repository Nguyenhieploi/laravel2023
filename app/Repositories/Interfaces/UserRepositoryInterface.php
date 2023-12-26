<?php
namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserRepositoryInterface
{
//  Đại diện cho tất cả repository, khi muon sử dụng phải khai báo ở đây
    public function getAllPaginate();
}
