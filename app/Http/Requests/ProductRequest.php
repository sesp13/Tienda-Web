<?php

namespace App\Http\Requests;

use App\Logic\UserLogic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        $admin = UserLogic::isAdmin($user);
        if ($admin) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->input('id');

        return [
            'alt_code' => ['nullable', 'unique:products,alt_code,' . $id],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'image_path' => ['image', 'mimes:jpg,jpeg,png,gif'],
            'stock' => ['numeric', 'required', '']
        ];
    }
}
