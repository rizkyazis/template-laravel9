<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        if ($request->search) {
            $users = User::where('name', 'like', '%' . $request->search . '%')->with('roles')->paginate(10);
        } else {
            $users = User::with('roles')->paginate(10);
        }
        return view('admin.user.list')->with('users', $users);
    }

    public function updatePage($id)
    {
        $user = User::where('id', $id)->with('roles')->first();

        $roles = Role::all();
        return view('admin.user.edit')->with('user', $user)->with('roles', $roles);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->with('roles')->first();
        if ($user->email == $request->email) {
            $user->update([
                'name' => $request->name
            ]);
        } else {
            $checkUserMail = User::where('email', $request->email)->get();
            if (count($checkUserMail) > 0) {
                toastr()->error('Email Already Registered');
                return redirect()->back()->withInput();
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

        }

        toastr()->success('User Updated Successfully');
        return redirect()->back();
    }

    public function addRole(Request $request, $idUser)
    {
        $userRole = UserRole::where('user_id', $idUser)->where('role_id', $request->idRole)->get();

        if (count($userRole) > 0) {
            toastr()->warning('This User already have this Role');
            return redirect()->back();
        }

        UserRole::create([
            'user_id'=>$idUser,
            'role_id'=>$request->idRole
        ]);
        toastr()->success('User Role Added Successfully');
        return redirect()->back();
    }

    public function deleteRole($idUser, $idRole)
    {
        $userRole = UserRole::where('user_id', $idUser)->where('role_id', $idRole)->first();
        $userRole->delete();

        toastr()->success('User Role Deleted Successfully');
        return redirect()->back();
    }

    public function delete($id)
    {
        dd($id);
        return route('admin.user.list');
    }
}
