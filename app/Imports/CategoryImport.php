<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Traits\CategoryCacheBuilder;

class CategoryImport implements ToCollection
{
    use CategoryCacheBuilder;
    public function collection(collection $rows)
    {
        foreach($rows as $row)
        {
            $counter_index=0;
            
            foreach($row as $get_cat)
            {
                if(!empty(trim($get_cat)) && !is_null($get_cat)){
                    $count_record = Category::Filter($get_cat)->orderby('id','desc');
                    $is_exists=0;
                    
                    $parent_index = $counter_index-1;
                    $parent_category_name = isset($row[$parent_index])?$row[$parent_index]:"";
                    $parent_category_id = NULL ;
                    
                    if($count_record->count() > 0 && empty($parent_category_name)) {
                        $is_exists = 1;
                    }
                    else{
                        if($count_record->count() >0){
                            $parent_name_main = $count_record->first()->parent;
                            if(!empty($parent_name_main)){
                                if($parent_name_main->category == $parent_category_name){
                                    $is_exists = 1;
                                }
                            }
                        }
                    }
                    if(!empty($parent_category_name))
                    { 
                        $parent_category = Category::Filter($parent_category_name)->orderBy('id','desc')->first();
                        if(!empty($parent_category->id))
                        {
                            $parent_category_id = $parent_category->id;
                        }
                    }
                    $existing_category_count = Category::Filter($get_cat)->orderBy('id','desc');
                    if($existing_category_count->count() == 0)
                    {
                        $category = new Category;
                        $category->category = $get_cat;
                        $category->description = "";
                        $category->parent_id = $parent_category_id;
                        $category->save();
                        $this->createCategoriesJsonFile();
                    }
                    else{
                        $parent_name_set = "";
                        $existing_category_parent = $existing_category_count->first()->parent;
                        if(!empty($existing_category_parent)){
                            $parent_name_set = $existing_category_parent->category;
                            if($parent_name_set != $parent_category_name && !empty($parent_category_name)){
                                $category = new Category;
                                $category->category = $get_cat;
                                $category->description = "";
                                $category->parent_id = $parent_category_id;
                                $category->save();
                                $this->createCategoriesJsonFile();
                            }
                        }
                    }
                }
                $counter_index++;
            }
        }
    }
}
