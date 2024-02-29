<?php
namespace App\Services\Interfaces;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces
 */
interface UserCatalogueServiceInterface
{
//  Đại diện cho tất cả service, khi muon sử dụng phải khai báo ở đây
    public function paginate($request);
  
}
 