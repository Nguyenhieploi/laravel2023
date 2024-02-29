<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

     // Kiểm tra cập nhật User - $this->id là email 
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users,email,'.$this->id.'|max:191',
            'name' => 'required|string',
            'user_catalogue_id' => 'required|integer|gt:0',
        
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
          
        ];
    }
}
