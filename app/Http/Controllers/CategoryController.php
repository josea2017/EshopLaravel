<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Category/index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category/new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {/*
        $category_id = $request->input('category_id');
        $category_root_id = $request->input('category_root_id');
        $name = $request->input('name');
        $date = date('Y-m-d H:i:s');
        //Category::insert('insert into categories (category_id, category_root_id, name) values (?, ?, ?)', [$category_id, $category_root_id, $name]);
        //DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
        //DB::table('categories')->insert(array('category_id' => $category_id, 'category_root_id' => $category_root_id, 'name' => $name, 'created_at' => $date, 'updated_at' => $date));

        //DB::table('name')->insert(array('name' => 'John', 'email' => 'john@example.com'));
        $category = new Category;
        $category->category_id = Input::get("category_id");
        $category->category_root_id = Input::get("category_root_id");
        $category->name = Input::get("name");
        $category->created_at = $date;
        $category->updated_at = $date;
        $category->save();
        */
        $this->validate($request, [
            'category_id' => 'required', 
            'category_root_id' => 'required',
            'name' => 'required'
        ]);
        $category = new Category([
            'category_id' => $request->get('category_id'),
            'category_root_id' => $request->get('category_root_id'),
            'name' => $request->get('name')
        ]);
        try {
            $category->save();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('categories.create')->with('fail', 'Duplicate data');  
        }
        
        return redirect()->route('categories.index')->with('success', 'Data Added'); 

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
