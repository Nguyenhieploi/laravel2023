<?php
namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    protected $districtRepository;
    protected $provinceRepository;

    // Phương thức khởi tạo, chấp nhận một thể hiện của DistrictRepository
    public function __construct()
    {  
        
    }

    public function changeStatus(Request $request){
        $post = $request->input();
       
       $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
       if(class_exists($serviceInterfaceNamespace)){
        $serviceInstance = app($serviceInterfaceNamespace);
       }

        $flag =  $serviceInstance->updateStatus($post);
        return response()->json(['flag' => $flag]);
    }


    public function changeStatusAll(Request $request){
        $post = $request->input();
       
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if(class_exists($serviceInterfaceNamespace)){
         $serviceInstance = app($serviceInterfaceNamespace);
        }
        $flag =  $serviceInstance->updateStatusAll($post);
        return response()->json(['flag' => $flag]);
    }

}