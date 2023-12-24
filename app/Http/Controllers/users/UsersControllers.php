<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\users\User;
use App\Models\role\Role;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class UsersControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Index View and Scope Data
    public function index()
    {
        return view('users.index', [
            "title" => "List User",
            "users" => User::all()->where('deleted_at', null),
            "roles" => Role::all()->where('deleted_at', null)
        ]);
    }

    // Create View Data
    public function create()
    {
        $data['title'] = "Add User";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        $data['roles'] = Role::all();
        $data['required'] = 'required';
        return view('users.create', $data);
    }

    // Store Function to Database
    public function store(Request $request)
    {
        $exec = User::where('email', $request->email)->first();
        $exec_2 = User::where('username', $request->username)->first();
        $exec_3 = User::where('phone', $request->phone)->first();

        if ($exec || $exec_2 || $exec_3) {
            return back()->with(['gagal' => 'Your Email, Username or Phone Already Exist!']);
        } else {
            if ($request->password == $request->repassword) {

                $datenow = date('Y-m-d H:i:s');
                $sample = User::create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                    'name' => $request->name,
                    'role_id' => $request->role,
                    'address' => $request->address,
                    'created_at' => $datenow
                ]);
                return redirect()->route('admin.users.index')->with(['success' => 'Data successfully stored!']);
            } else {
                return back()->with(['gagal' => 'Password Not Match!']);
            }
        }
    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail User";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['users'] = User::where('id', $id)->first();
        $data['roles'] = Role::all();
        $data['required'] = '';
        return view('users.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['title'] = "Edit User";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['users'] = User::where('id', $id)->first();
        $data['roles'] = Role::all();
        $data['required'] = '';
        return view('users.create', $data);
    }

    // Update Function to Database
    public function update(Request $req)
    {
        $exec = User::where('email', $req->email)->first();
        $exec_2 = User::where('username', $req->username)->first();
        $exec_3 = User::where('phone', $req->phone)->first();

        if ($req->password && $req->repassword) {
            if ($req->password == $req->repassword) {

                $datenow = date('Y-m-d H:i:s');
                $user_pay = User::where('id', $req->id)->update([
                    'username' => $req->username,
                    'email' => $req->email,
                    'phone' => $req->phone,
                    'password' => bcrypt($req->password),
                    'name' => $req->name,
                    'role_id' => $req->role,
                    'address' => $req->address,
                    'updated_at' => $datenow
                ]);
                return redirect()->route('admin.users.index')->with(['success' => 'Data successfully updated!']);
            } else {
                return back()->with(['gagal' => 'Password Not Match!']);
            }
        } else {
            if ($exec || $exec_2 || $exec_3) {
                return back()->with(['gagal' => 'Your Email, Username or Phone Already Exist!']);
            } else {
                if ($req->password == $req->repassword) {

                    $datenow = date('Y-m-d H:i:s');
                    $user_pay = User::where('id', $req->id)->update([
                        'username' => $req->username,
                        'email' => $req->email,
                        'phone' => $req->phone,
                        'name' => $req->name,
                        'role_id' => $req->role,
                        'address' => $req->address,
                        'updated_at' => $datenow
                    ]);
                    return redirect()->route('admin.users.index')->with(['success' => 'Data successfully updated!']);
                } else {
                    return back()->with(['gagal' => 'Password Not Match!']);
                }
            }
        }
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec = User::where('id', $req->id)->update([
            'updated_at' => $datenow,
            'deleted_at' => $datenow
        ]);

        if ($exec) {
            Session::flash('success', 'Data successfully deleted!');
        } else {
            Session::flash('gagal', 'Error Data');
        }
    }
}
