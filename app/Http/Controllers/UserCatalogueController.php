<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    // Khai báo userservice, thay vì phải code nhìu trong file này thì chia ra 
    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository
        ){
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
        
    }

    public function index(Request $request){
       
        //  Lấy user ra 15 
        $userCatalogues = $this->userCatalogueService->paginate($request);
       
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
        $config['seo'] = config('app.userCatalogue');
        $template = 'user.catalogue.index';
        return view('dashboard.layout',compact('template','config','userCatalogues'));
    }

    // ========================================== Create nhóm thành viên =================================
    public function create(){
        // Xử lý html
        $config['seo'] = config('app.user');
        $config['method'] = 'create';
        $template = 'user.catalogue.store';
        return view('dashboard.layout',compact('template','config'));
    }

    // Xử lý thêm thành viên
    public function store(StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->create($request)){
            return redirect()->route('user.catalogue.index')->with('success','Thêm mới thành công');
        };
        return redirect()->route('user.catalogue.index')->with('error','Thêm mới thành viên thất bại');
    }

    public function edit($id){
        $userCatalogue = $this->userCatalogueRepository->findById($id);
       
        $config['seo'] = config('app.userCatalogue');
        $config['method'] = 'edit';
        $template = 'user.catalogue.store';
        return view('dashboard.layout',compact('template','config','userCatalogue'));
    }

    public function update($id, StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->update($id, $request)){
            return redirect()->route('user.catalogue.index')->with('success','Lưu thành công');
        };
        return redirect()->route('user.catalogue.index')->with('error','Lưu thất bại');
    }

    public function delete($id){
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $config['seo'] = config('app.user');
        $template = 'user.catalogue.delete';
        return view('dashboard.layout',compact('template','userCatalogue','config')); // lấy thông tin của user
    }

    public function destroy($id){
        if($this->userCatalogueService->destroy($id)){
            return redirect()->route('user.catalogue.index')->with('success','Xóa thành công');
        };
        return redirect()->route('user.catalogue.index')->with('error','Xóa thất bại');
    }
}
