<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index(Request $request)
    {
        $search = $request->get(key:'q');
        $categories = $this->category->latest('id')->where(column:'name', operator:'like', value:'%'.$search.'%')->paginate(3);
        return view('admin.categories.index',compact('categories','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with(['message'=>'Delete category: '.$category->name." success"]);
         
    }
    

}