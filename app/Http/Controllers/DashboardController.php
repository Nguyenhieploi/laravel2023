<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        /*
    $config quản lý các tệp tin JavaScript một cách cụ thể và có tổ chức hơn
    Khi cần thêm, xóa hoặc thay đổi các tệp tin JavaScript
    chỉ cần chỉnh sửa mảng 'js' trong biến $config một cách thuận tiện, 
    thay vì phải tìm kiếm và chỉnh sửa từng đoạn mã JavaScript đơn lẻ.
        */
        $config = $this->config();
        $template = 'dashboard.home.index';
        return view('dashboard.layout',compact(
            'template',
            'config'
        ));
    }
    private function config(){
        return [
            'js'=>[
               'js/plugins/flot/jquery.flot.js',
               'js/plugins/flot/jquery.flot.tooltip.min.js',
               'js/plugins/flot/jquery.flot.spline.js',
               'js/plugins/flot/jquery.flot.resize.js',
               'js/plugins/flot/jquery.flot.pie.js',
               'js/plugins/flot/jquery.flot.symbol.js',
               'js/plugins/flot/jquery.flot.time.js',
               'js/plugins/peity/jquery.peity.min.js',
               'js/demo/peity-demo.js',
               'js/inspinia.js',
               'js/plugins/pace/pace.min.js',
               'js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js',
               'js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
               'js/plugins/easypiechart/jquery.easypiechart.js',
               'js/plugins/sparkline/jquery.sparkline.min.js',
               'js/demo/sparkline-demo.js'
            ]
        ];
    }
}
