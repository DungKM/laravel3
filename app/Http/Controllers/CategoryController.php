<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
       
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function api()
    {
        return DataTables::of(Category::query())
        ->editColumn('parent_id', function ($object) {
            return $object->parent_name;
        })
        ->addColumn('edit', function ($object) {
            return route('categories.edit', $object);
        })
        ->addColumn('destroy', function ($object) {
            return route('categories.destroy', $object);
        })
        ->make(true);
    }
    public function create()
    {
       $parrentCategories = $this->category->getParents();
       return view('admin.categories.create',compact('parrentCategories'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        //
        $dataCreate = $request->all();
        $category = $this->category->create($dataCreate);
        return redirect()->route('categories.index')->with(['message'=>'Create New Category: '.$category->name." Success"]);
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $category = $this->category->with('childrens')->findOrFail($id);
        $parrentCategories = $this->category->getParents();
        return view('admin.categories.edit', compact('category','parrentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
       $dataUpdate = $request->all();
       $category = $this->category->findOrFail($id);
       $category->update($dataUpdate);
       return redirect()->route('categories.index')->with(['message'=>'Update category: '.$category->name." success"]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category->where('id',$id)->delete();
        $arr['status'] = true;
        $arr['message'] = '';
        return response($arr, 200);
         
    }
    

}