<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\category\Category;
use Session;

use Illuminate\Http\Request;

class CategoryControllers extends Controller
{

    // Index View and Scope Data
    public function index()
    {
        return view('category.index', [
            "title" => "List Category Product",
            "categories" => Category::all()
        ]);
    }

    // Create View Data
    public function create()
    {
        $data['title'] = "Add Category Product";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        return view('category.create', $data);
    }

    // Store Function to Database
    public function store(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');
        $category_prod = Category::create([  
            'category' => $req->category,
            'note' => $req->note,
            'created_at' => $datenow
        ]);

        return redirect()->route('category.index')->with(['success' => 'Data successfully stored!']);
    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail Category Product";
        $data['disabled_'] = 'disabled'; 
        $data['url'] = 'create';   
        $data['categories'] = Category::where('id', $id)->first();
        return view('category.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['title'] = "Edit Category Product";
        $data['disabled_'] = ''; 
        $data['url'] = 'update';   
        $data['categories'] = Category::where('id', $id)->first();
        return view('category.create', $data);
    }

    // Update Function to Database
    public function update(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');
        $category_prod = Category::where('id', $req->id)->update([  
            'category' => $req->category,
            'note' => $req->note,
            'updated_at' => $datenow
        ]);

        return redirect()->route('admin.category.index')->with(['success' => 'Data successfully updated!']);
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        $exec = Category::where('id', $req->id )->delete();

        if ($exec) {
            Session::flash('success', 'Data successfully deleted!');
          } else {
            Session::flash('gagal', 'Error Data');
          }
    }


}
