<?php

namespace App\Http\Controllers\forgot;

use App\Http\Controllers\Controller;
use App\Models\users\User;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use PDF;

class ForgotControllers extends Controller
{

    // Index View and Scope Data
    public function index()
    {
        return view('auth.forgot');
    }

    // Store Function to Database
    public function updatepass(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');

        $exec = count(User::where('email', $req->email)->get());

        if($exec == 1){
            if($req->password == $req->repassword){
                $email_update = User::where('email', $req->email)->update([
                    'password' => bcrypt($req->password),
                    'updated_at' => $datenow
                ]);

                return redirect('/')->with(['success' => 'Success Change Password!']);
            }else{
                return redirect()->route('forgot.index')->with(['gagal' => 'Unmatch Password!']);
            }
        }else{
            return redirect()->route('forgot.index')->with(['gagal' => 'Email Not Exist!']);
        }
    }

    // // Detail Data View by id
    // public function detail($id)
    // {
    //     $data['title'] = "Detail Supplier";
    //     $data['disabled_'] = 'disabled';
    //     $data['url'] = 'create';
    //     $data['suppliers'] = Supplier::where('id', $id)->first();
    //     return view('supplier.create', $data);
    // }

    // // Edit Data View by id
    // public function edit($id)
    // {
    //     $data['title'] = "Edit Supplier";
    //     $data['disabled_'] = '';
    //     $data['url'] = 'update';
    //     $data['suppliers'] = Supplier::where('id', $id)->first();
    //     return view('supplier.create', $data);
    // }

    // // Update Function to Database
    // public function update(Request $req)
    // {
    //     date_default_timezone_set("Asia/Bangkok");
    //     $datenow = date('Y-m-d H:i:s');
    //     $supplier_pay = Supplier::where('id', $req->id)->update([
    //         'supplier' => $req->supplier,
    //         'note' => $req->note,
    //         'updated_at' => $datenow
    //     ]);

    //     return redirect()->route('admin.supplier.index')->with(['success' => 'Data successfully updated!']);
    // }

    // // Delete Data Function
    // public function delete(Request $req)
    // {
    //     $exec = Supplier::where('id', $req->id )->delete();

    //     if ($exec) {
    //         Session::flash('success', 'Data successfully deleted!');
    //       } else {
    //         Session::flash('gagal', 'Error Data');
    //       }
    // }


}
