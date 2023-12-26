<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // nếu đã đăng xuất thì k thể vào lại trang dashboard bằng /dashboard 
        if(Auth::id() == null){
            return redirect()->route('auth.admin')->with('error','Phải đăng nhập để sử dụng chức năng này');
        }
        
        return $next($request);
    }
}
