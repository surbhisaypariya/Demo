<?php

namespace App\Http\Controllers;

use App\Models\Attatchment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Validator;
use File;
use DB;
use Auth;

class AttatchmentController extends Controller
{
    public function index(Request $request)
    {
        
    }
    
    public function store(Request $request , $id)
    {
        $validation = Validator::make($request->all(), [
            'upload_input' => 'required|mimes:doc,docx,pdf,xls,xlsx,jpg,jpeg,png|max:10240', 
        ]);
        
        if($validation->passes()){
            if ($files = $request->file('upload_input')) {
                $file = $request->file('upload_input');
                $new_name = $file->getClientOriginalName();
                
                $path = public_path('documents/'.$new_name);
                if(!File::exists($path))
                {
                    $files = $file->move((public_path('documents')),$new_name);
                    
                    $attatchment = new Attatchment;
                    $attatchment->image_name = $new_name;
                    $attatchment->status = 1;
                    $attatchment->user_id = Auth::user()->id;
                    $attatchment->save();
                    
                    $product_id = $id;
                    $attatchments = $attatchment->id;
                    $attatchment->product()->attach($product_id);
                    
                    $product = Product::where('id',$id)->first();
                    $product_attatchment=$product->attatchment;
                    $payload = view('product.product_attatchment',compact('product_attatchment'))->render();
                    
                    return response()->json([
                        'message' => "Image Uploaded Successfully",
                        'upload_image' => $payload,
                        'class_name' => 'alert alert-success',
                    ]);
                    
                }
                else{
                    return response()->json([
                        'message' => "File already Exists....",
                        'class_name' => 'alert alert-danger',
                    ]);
                }
            }
        }
        else{
            return response()->json([
                'message' => $validation->errors()->all(),
                'upload_image' => '',
                'class_name' => 'alert alert-danger',
            ]);
        }
    }
    
    public function image_download($image_name)
    {
        $filepath = public_path('documents/'.$image_name);
        
        return response()->download($filepath , $image_name);
    }
    
    public function image_remove($id)
    {
        DB::table('attatchments')->where('id',$id)->update(["status"=> 0]);
        return redirect()->back();
    }
    
    public function image_restore($id)
    {
        DB::table('attatchments')->where('id',$id)->update(["status"=> 1]);
        return redirect()->back();
    }
    public function attachments(Request $request)
    {
        return view('product.product_attatchment_show');
    }
    
    public function ajaxFetchData(Request $request)
    {
        $columns = array(
            0 => 'product_code',
            1 => 'BrandName/Manufecture',
            2 => 'File Name',
            3 => 'Date',
            4 => 'Uploaded_by',
            5 => 'Action',
        );
        
        $data = array();
        
        $attatchments = Attatchment::with('product')->get();
        foreach($attatchments as $attatchment )
        {
            $nested_data = array();
            
            foreach($attatchment->product as $product)
            {
                $nested_data[] = $product->product_code;
                $nested_data[] =$product->brand_name . '/' . $product->manufacture ;
            }
            $nested_data[] = $attatchment->image_name;
            $nested_data[] = $attatchment->created_at;
            
            $user_id = $attatchment->user_id ;
            $username = User::find($user_id);
            $nested_data[] = $username->username ;
            
            
            if($attatchment->status == 0)
            {
                $nested_data[] = '<a  href="'. route('image_download',$attatchment->image_name ) .'"  class="btn btn-success btn-xs fa fa-download"></a><a  href="' .route('image_restore',$attatchment->id ) .'" class="btn btn-success btn-xs fa fa-plus"></a>';
            }
            else{
                $nested_data[] = '<a  href="'. route('image_download',$attatchment->image_name ) .'"  class="btn btn-success btn-xs fa fa-download"></a><a  href="' .route('image_remove',$attatchment->id ) .'" class="btn btn-success btn-xs fa fa-times"></a>';
            }
            $data[] = $nested_data;
        }
        
        $json_data = array(
            "draw" => intval($request['draw']),
            "data" => $data
        );
        echo  json_encode($json_data);
    }
}
