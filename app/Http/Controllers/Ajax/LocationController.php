<?php
namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
class LocationController extends Controller
{
    protected $districtRepository;
    protected $provinceRepository;

    // Phương thức khởi tạo, chấp nhận một thể hiện của DistrictRepository
    public function __construct(DistrictRepository $districtRepository, ProvinceRepository $provinceRepository)
    {   
        $this->districtRepository = $districtRepository;
        $this->provinceRepository = $provinceRepository;
    }

    // Phương thức xử lý yêu cầu lấy thông tin vị trí
    public function getLocation(Request $request){
        $get = $request->input();

        $html = '';
        if($get['target'] === 'districts'){
            $province = $this->provinceRepository->findById($get['data']['location_id'], ['code','name'],['districts']);
            $html = $this->renderHtml($province->districts);
        }else if($get['target'] == 'wards'){
            $district = $this->districtRepository->findById($get['data']['location_id'], ['code','name'],['wards']);
            $html = $this->renderHtml($district->wards,'[Chọn phường/xã]');
        }
      
       $response = [
        'html' => $html
       ];
       // Trả về dữ liệu dưới dạng JSON
       return response()->json($response);
    }

    // Phương thức để tạo chuỗi HTML chứa các lựa chọn quận/huyện
    public function renderHtml($districts,$root = '[Chọn quận huyện]'){
        $html = '<option value="0">'.$root.'</option>';
        foreach($districts as $district){
            // Thêm lựa chọn quận/huyện vào chuỗi HTML
            $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        // Trả về chuỗi HTML đã tạo
        return $html;
    }
}
