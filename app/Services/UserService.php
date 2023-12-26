<?php

namespace App\Services;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    // File xử lý chi tiết User để cho file UserController nhận giá trị
    public function paginate(){
        $users = $this->userRepository->getAllPaginate();
        return $users;
    }


    // Xử lý tính năng thêm mới user
    public function create(Request $request){
        // Bắt đầu một giao dịch
        DB::beginTransaction();
        try{
            // Thực hiện các hành động cần thiết ở đây
            $payload = $request->except('_token','send','re_pasword'); // hàm except là loại trừ 
            $carbonDate = Carbon::createFromFormat('Y-m-d', $payload['birthday']);
            $payload['birthday'] = $carbonDate->format('Y-m-d');
           $payload['password'] = Hash::make($payload['password']); // Mã hóa password khi đưa vào csdl


            $user = $this->userRepository->create($payload); 
          
            // Nếu mọi thứ thành công, cam kết giao dịch
            DB::commit();
            return true; // Trả về true nếu giao dịch thành công
        }catch(\Exception $e){
            // Nếu có lỗi, hủy bỏ giao dịch và in ra thông báo lỗi cụ thể
            DB::rollBack();
            echo $e->getMessage(); // In ra thông báo lỗi cụ thể
            die(); // Dừng chương trình
            return false; // Trả về false nếu có lỗi xảy ra
        }
    }
}
