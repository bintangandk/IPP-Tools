<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ManagementUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('user_id')) {
            $query->where('user_id', 'like', '%' . $request->user_id . '%');
        }

        if ($request->filled('role') && $request->role != 'semua') {
            $query->where('roles', 'like', '%' . $request->role . '%');
        }

        if ($request->has('export')) {
            return Excel::download(new UsersExport($request->user_id, $request->role), 'users.xlsx');
        }

        $users = $query->get();
        $users_roles = User::distinct()->pluck('roles');

        return view('page.user-management.data-user')->with([
            'title' => 'IPP Tools - Management User',
            'users' => $users,
            'users_roles' => $users_roles
        ]);

    }

    public function create()
    {
        return view('page.user-management.create-user')->with([
            'title' => 'IPP Tools - Management User',
        ]);
    }

    public function createPost()
    {
        try {
            request()->validate([
                'user_id' => 'required|string',
                'full_name' => 'required|string|max:255',
                'type' => 'required|string|max:100',
                'region' => 'required|string|max:100',
                'teritory' => 'required|string|max:100',
                'status' => 'required|string',
                'level' => 'required|string|in:Admin,User',
                'password' => 'required|string',
                'roles' => 'required|string|max:100',
            ]);

            $user = new User();
            $user->user_id = request('user_id');
            $user->full_name = request('full_name');
            $user->type = request('type');
            $user->region = request('region');
            $user->teritory = request('teritory');
            $user->status = request('status');
            $user->level = request('level');
            $user->password = Hash::make(request('password'));
            $user->roles = request('roles');
            $user->img = 'user.jpg';
            $user->save();

            Alert::toast('Data berhasil di simpan', 'success');
            return redirect()->route('management-user');
        } catch (Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function delete()
    {
        try {
            User::where('user_id', request('user_id'))->delete();
            Alert::toast('Data berhasil di hapus', 'success');
            return back();
        } catch (Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function edit($user_id) {

        $id_dec = Decrypt($user_id);
        $user = User::where('user_id', $id_dec)->first();
        return view('page.user-management.edit-user')->with([
            'title' => 'IPP Tools - Management User',
            'user' => $user
        ]);
    }

    public function editPost($user_id) {
        try {
            request()->validate([
                'user_id' => 'required|string',
                'full_name' => 'required|string|max:255',
                'type' => 'required|string|max:100',
                'region' => 'required|string|max:100',
                'teritory' => 'required|string|max:100',
                'status' => 'required|string',
                'level' => 'required|string|in:Admin,User',
                'roles' => 'required|string|max:100',
            ]);

            $user = User::where('user_id', $user_id)->first();
            $user->user_id = request('user_id');
            $user->full_name = request('full_name');
            $user->type = request('type');
            $user->region = request('region');
            $user->teritory = request('teritory');
            $user->status = request('status');
            $user->level = request('level');
            $user->roles = request('roles');
            $user->save();

            Alert::toast('Data berhasil di update', 'success');
            return redirect()->route('management-user');
        } catch (Exception $error) {
            Log::error($error->getMessage());
        }
    }
}
