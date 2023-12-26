<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users|max:191',
            'name' => 'required|string',
            'user_catalogue_id' => 'required|integer|gt:0',
            'password' => 'required|string|min:6',
            're_pasword' => 'required|string|same:password',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'email.string' => 'Email phải là dạng ký tự',
            'email.max' => 'Độ dài tối đa 191 kí tự',
            'name.required' => 'Bạn chưa nhập họ tên',
            'name.string' => 'Name Phải là dạng ký tự',
            'user_catalogue_id.gt' => 'Chưa chọn nhóm thành viên',
            'password.required' => 'Bạn chưa nhập password',
            'password.string' => 'Pass Phải là dạng ký tự',
            're_pasword.required' => 'Bạn chưa nhập mật khẩu xác nhận',
            're_pasword.same' => 'Mật khẩu không khớp'
        ];
    }
}
