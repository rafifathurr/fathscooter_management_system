<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use App\Models\role\Role;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class RoleControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Index View and Scope Data
    public function index()
    {
        return view('role.index', [
            "title" => "List User Roles",
            "roles" => Role::all()->where('deleted_at', null)
        ]);
    }

    // Create View Data
    public function create()
    {
        $data['title'] = "Add User Roles";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        return view('role.create', $data);
    }

    // Store Function to Database
    public function store(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $role_pay = Role::create([
            'role' => $req->role,
            'note' => $req->note,
            'created_at' => $datenow
        ]);

        return redirect()->route('admin.role.index')->with(['success' => 'Data successfully stored!']);
    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail User Roles";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['roles'] = Role::where('id', $id)->first();
        return view('role.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['title'] = "Edit User Roles";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['roles'] = Role::where('id', $id)->first();
        return view('role.create', $data);
    }

    // Update Function to Database
    public function update(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $role_pay = Role::where('id', $req->id)->update([
            'role' => $req->role,
            'note' => $req->note,
            'updated_at' => $datenow
        ]);

        return redirect()->route('admin.role.index')->with(['success' => 'Data successfully updated!']);
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec = Role::where('id', $req->id)->update([
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
