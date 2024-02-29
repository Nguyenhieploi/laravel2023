<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;
    // Khai báo userservice, thay vì phải code nhìu trong file này thì chia ra 
    public function __construct(
        UserService $userService,
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository
        ){
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request){
        //  Lấy user ra 15 
        $users = $this->userService->paginate($request);
       
        // Gọi biến config để file UserController này chỉ sử dụng css và js cho trang này
        $config = [
            'css'=>[
                'css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js'=>[
                'js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ]
        ];

        // Truy cập vào file config lấy ra mảng index và title cho blade 
        $config['seo'] = config('app.user');
        $template = 'user.user.index';
        return view('dashboard.layout',compact('template','config','users'));
    }

    // ========================================== Create User =================================
    public function create(){
        // Lấy thành phố từ db ra provinceRepository và gọi nó vào đây
        $provinces = $this->provinceRepository->all();
       
        //Thêm file select2 vào để mỗi public này chỉ sd nó tránh việc trùng code 
        $config = [
            'css'=> [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'library/location.js',
            ]
        ];

        $config['seo'] = config('app.user');
        $config['method'] = 'create';
        $template = 'user.user.store';
        return view('dashboard.layout',compact('template','config','provinces'));
    }

    // Xử lý thêm thành viên
    public function store(StoreUserRequest $request){
        if($this->userService->create($request)){
            return redirect()->route('user.index')->with('success','Thêm mới thành công');
        };
        return redirect()->route('user.index')->with('error','Thêm mới thành viên thất bại');
    }

    public function edit($id){
        $user = $this->userRepository->findById($id);
        $provinces = $this->provinceRepository->all();   // Lấy thành phố từ db ra provinceRepository và gọi nó vào đây
       
        //Thêm file select2 vào để mỗi public này chỉ sd nó tránh việc trùng code 
        $config = [
            'css'=> [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'library/location.js',
            ]
        ];

        $config['seo'] = config('app.user');
        $config['method'] = 'edit';
        $template = 'user.user.store';
        return view('dashboard.layout',compact('template','config','provinces','user'));
    }

    public function update($id, UpdateUserRequest $request){
        if($this->userService->update($id, $request)){
            return redirect()->route('user.index')->with('success','Lưu thành công');
        };
        return redirect()->route('user.index')->with('error','Lưu thất bại');
    }

    public function delete($id){
        $user = $this->userRepository->findById($id);
        $config['seo'] = config('app.user');
        $template = 'user.user.delete';
        return view('dashboard.layout',compact('template','user','config')); // lấy thông tin của user
    }

    public function destroy($id){
        if($this->userService->destroy($id)){
            return redirect()->route('user.index')->with('success','Xóa thành công');
        };
        return redirect()->route('user.index')->with('error','Xóa thất bại');
    }
}
