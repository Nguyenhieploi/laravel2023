<?php

namespace App\Services;
use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
/**
 * Class UserCatalogueService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;

    public function __construct(UserCatalogueRepository $userCatalogueRepository)
    {
        $this->userCatalogueRepository = $userCatalogueRepository;
    }
    
 
    //Phân trang dựa theo userRepository sẽ ket noi vs CSDL
    public function paginate($request){

        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->input('publihs');
        $perPage = $request->input('perpage');
        $userCatalogues = $this->userCatalogueRepository->pagination($this->select(), $condition,[],['path' => 'user/catalogue/index'],$perPage,['users']);
       
        return $userCatalogues;
    }

    // Xử lý tính năng thêm mới nhóm thành viên
    public function create(Request $request){
        DB::beginTransaction();
        try{
            $payload = $request->except('_token','send'); // hàm except là loại trừ 
            $user = $this->userCatalogueRepository->create($payload);  // Gọi tới repository
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
            $user = $this->userCatalogueRepository->update($id, $payload); 
            DB::commit();
            return true; 
        }catch(\Exception $e){
            DB::rollBack();
            echo $e->getMessage(); // In ra thông báo lỗi cụ thể
            die(); // Dừng chương trình
            return false; 
        }
    }

   
    public function destroy($id){
        // Bắt đầu một giao dịch
        DB::beginTransaction();
        try{
           $user = $this->userCatalogueRepository->delete($id);
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
            'name',
            'description',
            'publish'
        ];
    }

    public function updateStatus($post = []){
        DB::beginTransaction();
        try{
          
            $payload = [
                $post['field'] => (($post['value'] == 1 ) ? 0 : 1)
            ];
        
            $user = $this->userCatalogueRepository->update($post['modelId'],$payload);

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
        
            $flag = $this->userCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
            
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
