<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Repositories\User\UserRepositoryInterface;

class UserRequest extends FormRequest
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $userId = Auth::user()->id;
        $user = $this->userRepository->findById($userId);

        if ($user->is_admin) {
            return true;
        } else {
            return fase;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'PUT') {
            $userId = Auth::user()->id;

            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $userId
            ];
        } else {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ];
        }

        return $rules;
    }
}
