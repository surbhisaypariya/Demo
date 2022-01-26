<?php
namespace App\Http\Traits;

use App\Models\Category;
use Illuminate\Support\Facades\storage;

trait CategoryCacheBuilder{

    public function createCategoriesJsonFile()
    {
        $parent_categories = Category::latest()->parents()->get();
        $categories =json_encode($this->buildTreeArrayforSortview($parent_categories),JSON_INVALID_UTF8_IGNORE);
        Storage::disk('public')->put('json/categories.json', $categories);
    }

    public function buildTreeArrayforSortview($objects)
    {   
        $data = array();
        foreach ($objects as $key => $object) {
            $data[$key]['label'] 		= $object->category;
            $data[$key]['id'] 			= $object->id;
            $data[$key]['parent_id'] 			= $object->parent_id;
            if(count($object->children)){
                $data[$key]['children'] = $this->buildTreeArrayforSortview($object->children);
            }
        }
        return $data;
    }

}
?>