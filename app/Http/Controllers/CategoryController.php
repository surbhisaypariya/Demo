<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\CategoryCacheBuilder;
use Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryImport;

class CategoryController extends Controller
{
    use CategoryCacheBuilder;
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    
    public function __construct()
    {
        $this->middleware('auth');
        
        $exists = Storage::disk('public')->exists('json/categories.json');
        
        if(!$exists){
            $this->createCategoriesJsonFile();
        }
    }
    
    public function index()
    {
        return view('category.show');
    }
    
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $categories = Category::parents()->get();
        return view('category.create',compact('categories'));
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);
        
        $categories =new Category;
        $categories->category = $request['category'];
        $categories->description = $request['description'];
        $categories->parent_id = $request['parent_id'];
        $categories->save();
        
        $this->createCategoriesJsonFile();        
        
        return redirect()->route('category.index')->with('success','category inserted successfully!!');
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Category  $category
    * @return \Illuminate\Http\Response
    */
    public function show(Category $category)
    {
        return view('category.show',compact('category'));
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Category  $category
    * @return \Illuminate\Http\Response
    */
    public function edit(Category $category)
    {
        $categories = Category::where('id' , '!=' , $category->id)->parents()->get();
        // dd($categories);
        
        return view('category.edit',compact('category','categories'));
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Category  $category
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);
        
        $category->update([
            "category" => $request->get('category'),
            "description" => $request->get('description'),
            "parent_id" => $request->get('parent_id'),
            ]) ;
            
            $category->update();
            
            $this->createCategoriesJsonFile();
            
            return redirect()->route('category.index')->with('info','Category Updated Successfully !!!');
        }
        
        /**
        * Remove the specified resource from storage.
        *
        * @param  \App\Models\Category  $category
        * @return \Illuminate\Http\Response
        */
        public function destroy(Category $category)
        {
            $parent_id = $category->parent_id;
            $categories = Category::where('parent_id',$category->id)->get()->pluck('id');
            $update = Category::whereIn('id',$categories)->update(['parent_id'=>$parent_id]);
            $category->delete();
            
            $this->createCategoriesJsonFile();
            
            return redirect()->route('category.index')->with('error','Category Deleted Successfully !!!');
        }
        
        public function ajaxstore(Request $request)
        {
            if($request->ajax())
            {
                if(!empty($request->data)){
                    $set_data=$request->data;
                    foreach($set_data as $cat_data){
                        
                        $set_parent_id=$cat_data['id'];
                        
                        Category::where('id', $cat_data['id'])->update(array("parent_id" =>null));
                        
                        if(!empty($cat_data['children'])){
                            $this->savedCategorySortviewData($cat_data['children'],$set_parent_id);
                        }
                    }
                }
                $this->createCategoriesJsonFile();
            }
            $request->session()->flash('success',trans("Update Successfully"));
        }
        
        public function savedCategorySortviewData($data,$parent_id)
        {
            foreach($data as $cat_data){
                
                Category::where('id', $cat_data['id'])->update(array("parent_id" =>$parent_id));
                
                if(!empty($cat_data['children'])){
                    $this->savedCategorySortviewData($cat_data['children'],$cat_data['id']);
                }
            }
        }

        public function importExcelDataCategory(Request $request)
        {
            $data = Excel::import(new CategoryImport, $request->file('csvfile'));
            $this->createCategoriesJsonFile(); 
            return redirect()->route('category.index')->with('success','Record Inserted Successfully');
        }
        
    }
    