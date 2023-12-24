<?php

namespace App\Http\Controllers\source_payment;

use App\Http\Controllers\Controller;
use App\Models\source_payment\Source;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class SourceControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Index View and Scope Data
    public function index()
    {
        return view('source_payment.index', [
            "title" => "List Source Purchase",
            "sources" => Source::all()->where('deleted_at', null)
        ]);
    }

    // Create View Data
    public function create()
    {
        $data['title'] = "Add Source Purchase";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        return view('source_payment.create', $data);
    }

    // Store Function to Database
    public function store(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $source_pay = Source::create([
            'source' => $req->sumber,
            'note' => $req->note,
            'created_at' => $datenow
        ]);

        return redirect()->route('admin.source_purchase.index')->with(['success' => 'Data successfully stored!']);
    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail Source Purchase";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['sources'] = Source::where('id', $id)->first();
        return view('source_payment.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['title'] = "Edit Source Purchase";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['sources'] = Source::where('id', $id)->first();
        return view('source_payment.create', $data);
    }

    // Update Function to Database
    public function update(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $source_pay = Source::where('id', $req->id)->update([
            'source' => $req->sumber,
            'note' => $req->note,
            'updated_at' => $datenow
        ]);

        return redirect()->route('admin.source_purchase.index')->with(['success' => 'Data successfully updated!']);
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec = Source::where('id', $req->id)->update([
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
