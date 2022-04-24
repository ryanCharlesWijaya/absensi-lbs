<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(16);

        return view("guru.user.index", compact("users"));
    }

    public function show(int $user_id)
    {
        $user = user::findOrFail($user_id);

        return view("guru.user.user-detail", compact("user"));
    }

    public function create()
    {
        return view("guru.user.create-user");
    }

    public function store(Request $request, UserService $userService)
    {
        DB::beginTransaction();
        try {
            $userService->createUser($request->all());

            DB::commit();            
            return redirect(route("guru.user.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(Request $request, int $user_id)
    {
        $user = user::findOrFail($user_id);

        return view("guru.user.edit-user", compact("user"));
    }

    public function updateDetail(Request $request, userService $userService, int $user_id)
    {
        DB::beginTransaction();
        try {
            $user = $userService->updateUserDetail($request->all(), $user_id);

            DB::commit();
            return redirect(route("guru.user.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updatePassword(Request $request, userService $userService, int $user_id)
    {
        DB::beginTransaction();
        try {
            $user = $userService->updateUserPassword($request->all(), $user_id);

            DB::commit();
            return redirect(route("guru.user.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
