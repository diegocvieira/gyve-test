<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use Auth;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $pages = 10;

        $users = $this->userRepository->allPaginated($pages);

        return view('user.index', compact('users'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $type = $request->type;
        $pages = 10;

        $users = $this->userRepository->searchPaginated($request, $pages);

        return view('user.index', compact('users', 'type', 'keyword'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            $this->userRepository->create($data);
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->withErrors($th->getMessage());
        }

        return redirect()->route('user.index')->withSuccess('User successfully created');
    }

    public function edit()
    {
        $userId = Auth::user()->id;

        $user = $this->userRepository->findById($userId);

        return view('user.edit', compact('user'));
    }

    public function update(UserRequest $request)
    {
        try {
            $userId = Auth::user()->id;
            $data = $request->all();

            if ($data['password']) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }

            $this->userRepository->update($userId, $data);
        } catch (\Throwable $th) {
            return redirect()->route('user.edit')->withErrors($th->getMessage());
        }

        return redirect()->route('user.edit')->withSuccess('User successfully updated');
    }

    public function destroy()
    {
        try {
            $userId = Auth::user()->id;

            $this->userRepository->destroy($userId);
        } catch (\Throwable $th) {
            return redirect()->route('user.login')->withErrors($th->getMessage());
        }

        return redirect()->route('user.login')->withSuccess('User successfully deleted');
    }
}
