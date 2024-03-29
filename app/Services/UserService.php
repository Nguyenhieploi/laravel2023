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
    
 
    //Phân trang dựa theo userRepository sẽ ket noi vs CSDL
    public function paginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perPage = $request->input('perpage');
        $users = $this->userRepository->pagination($this->select(), $condition,[],['path' => 'user/index'],$perPage);
        return $users;
    }

  

    // Xử lý tính năng thêm mới user
    public function create(Request $request){
        DB::beginTransaction();
        try{
            $payload = $request->except('_token','send','re_pasword'); // hàm except là loại trừ 
            if(!is_null($payload['birthday'])){
                $this->convertBirthdayDate($payload['birthday']);
             }
            $payload['password'] = Hash::make($payload['password']); // Mã hóa password khi đưa vào csdl
            $user = $this->userRepository->create($payload); 
          
            DB::commit();
            return true; 
        }catch(\Exception $e){
            DB::rollBack();
            echo $e->getMessage(); // In ra thông báo lỗi cụ thể
            die(); // Dừng chương trình
            return false; // Trả về false nếu có lỗi xảy ra
        }
    }

    public function update($id, $request){
        // Bắt đầu một giao dịch
        DB::beginTransaction();
        try{
          
            $payload = $request->except('_token','send'); // hàm except là loại trừ 
            if(!is_null($payload['birthday'])){
               $this->convertBirthdayDate($payload['birthday']);
            }
            $user = $this->userRepository->update($id, $payload); 
            DB::commit();
            return true; // Trả về true nếu giao dịch thành công
        }catch(\Exception $e){
            // Nếu có lỗi, hủy bỏ giao dịch và in ra thông báo lỗi cụ thể
            DB::rollBack();
            echo $e->getMessage(); // In ra thông báo lỗi cụ thể
            die(); // Dừng chương trình
            return false; 
        }
    }

    private function convertBirthdayDate($birthday = ''){
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }

    public function destroy($id){
        // Bắt đầu một giao dịch
        DB::beginTransaction();
        try{
          
           $user = $this->userRepository->delete($id);
            DB::commit();
            return true; // Trả về true nếu giao dịch thành công
        }catch(\Exception $e){
            // Nếu có lỗi, hủy bỏ giao dịch và in ra thông báo lỗi cụ thể
            DB::rollBack();
            echo $e->getMessage(); // In ra thông báo lỗi cụ thể
            die(); // Dừng chương trình
            return false; 
        }
    }

    public function select(){
        return [
            'id',
            'email',
            'phone',
            'address',
            'name',
            'publish',
            'user_catalogue_id'
        ];
    }

    public function updateStatus($post = []){
        DB::beginTransaction();
        try{
          
            $payload = [
                $post['field'] => (($post['value'] == 1 ) ? 0 : 1)
            ];
        
            $user = $this->userRepository->update($post['modelId'],$payload);

            DB::commit();
            return true; // Trả về true nếu giao dịch thành công
        }catch(\Exception $e){
            DB::rollBack();
            echo $e->getMessage(); 
            die();
            return false; 
        }
    }

    public function updateStatusAll($post){
        DB::beginTransaction();
        try{
            $payload[$post['field']] = $post['value'];
        
            $flag = $this->userRepository->updateByWhereIn('id', $post['id'], $payload);
            
            DB::commit();
            return true; // Trả về true nếu giao dịch thành công
        }catch(\Exception $e){
            DB::rollBack();
            echo $e->getMessage(); 
            die();
            return false; 
        }
    }


    
}
