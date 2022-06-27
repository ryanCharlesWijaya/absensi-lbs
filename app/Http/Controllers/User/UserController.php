<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::role("admin")->paginate(16);

        return view("guru.user.index", compact("users"));
    }

    public function listSiswa()
    {
        $siswas = User::role("siswa")->paginate(16);

        return view("guru.user.list-siswa", compact("siswas"));
    }

    public function show(int $user_id)
    {
        $user = user::findOrFail($user_id);

        return view("guru.user.user-detail", compact("user"));
    }

    public function create()
    {
        return view("guru.user.create");
    }

    public function createSiswa()
    {
        return view("guru.user.create-siswa");
    }

    public function store(Request $request, UserService $userService)
    {
        DB::beginTransaction();
        try {
            $user = $userService->createUser($request->all());            

            DB::commit();
            if ($user->role == "siswa") return redirect(route("guru.user.listSiswa"));
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
            if ($user->role == "siswa") return redirect(route("guru.user.listSiswa"));
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
            if ($user->role == "siswa") return redirect(route("guru.user.listSiswa"));
            return redirect(route("guru.user.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function delete(UserService $userService, $user_id)
    {
        DB::beginTransaction();

        try {
            $userService->deleteUser($user_id);

            DB::commit();
            return back();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
