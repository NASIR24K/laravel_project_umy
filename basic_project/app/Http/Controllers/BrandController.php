<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipicture;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class BrandController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    function AllBrand(){
        $brand=Brand::latest()->paginate(4);
        return view('admin.brand.index', compact('brand'));
    }

   function StoreBrand(Request $request){
     //  dd($request->all());
    $validated = $request->validate([
        'brand_name' => 'required|unique:brands|min:4',
        'brand_image' => 'required|mimes:jpeg,png,jpg',

        
    ],
    [
        'brand_name.required' => 'Please Input Brand Name',
        'brand_image.min' => 'Brand less than 4 character',
    ]);

           $brand_image=$request->hasfile('brand_image');
           $brand_image=$request->file('brand_image');
           $name_gen=Str::random(5);
             $img_ext=$brand_image->GetClientOriginalName();
             $last_img= $name_gen.'.'.$img_ext;
           // dd($last_img);
             $brand_image->move('images/brand/',$last_img); 

            /* $name_gen=hexdec(uniqid());
            $img_ext=Strtolower($brand_image->getClientOriginalExtension());
            $img_name=$name_gen.'.'.$img_ext;
             $up_location='images/brand/';
            $last_img=$up_location.$img_name;
            $brand_image->move($up_location,$img_name); */

       /*      $name_gen=hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(300,200)->save('images/brand/'.$name_gen);
            $last_img='images/brand/'.$name_gen; */
            
           Brand::insert([
                 'brand_name'=>$request->brand_name,
                 'brand_image'=>$last_img,
                 'created_at'=>Carbon::now(),
           ]);
           return redirect()->route('all.brand')->with('success', 'Brand Added Successfully');

   }


   function BrandEdit($id){
      
       $edit=Brand::find($id);
       return view('admin.brand.edit', compact('edit'));
   }
   function updateBrand(Request $request,$id){
    $validated = $request->validate([
        'brand_name' => '|min:4',

        
    ],
    [
        'brand_name' => 'Please Input Brand Name',
        'brand_image.min' => 'Brand less than 4 character',
    ]);
         $old_image=$request->old_image;
           $brand_image=$request->file('brand_image');
          /*    $name_gen=Str::random(5);
             $img_ext=$brand_image->GetClientExtension();
             $img_name= $name_gen.'.'.$img_ext;
             $brand_image->move('public/images/brand/',$img_name); */
      if($old_image==$brand_image){
            $name_gen=Str::random(5);
            $img_ext=$brand_image->GetClientOriginalName();
            $last_img= $name_gen.'.'.$img_ext;
           /*  $name_gen=hexdec(uniqid());
            $img_ext=Strtolower($brand_image->getClientOriginalName());
            $img_name=$name_gen.'.'.$img_ext; */
             $up_location='images/brand/';
            //$last_img=$up_location.$img_name;
            $brand_image->move($up_location,$last_img);
           @unlink($old_image);
           Brand::find($id)->update([
                 'brand_name'=>$request->brand_name,
                 'brand_image'=>$last_img,
                 'created_at'=>Carbon::now(),
           ]);
           return redirect()->route('all.brand')->with('success', 'Brand Update Successfully');
        }else{
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'created_at'=>Carbon::now(),
          ]);
          return redirect()->route('all.brand')->with('success', 'Brand Update Successfully');
        }
   }


   function BrandDelete($id){
    $imaged=Brand::find($id);
    $image=$imaged->brand_image;
    @unlink($image);
    Brand::find($id)->delete();
    return redirect()->route('all.brand')->with('success', 'Brand Delete Successfully');

   }

   ////tjis is multi Image All method
  
   function MultiImage(){
    $image=Multipicture::all();
       return view('admin.multimage.index', compact('image') );
   }

   function StoreImage(Request $request){
    $validated = $request->validate([
        'image' => 'required',
    ],
    [
        'image.min' => 'image less than 4 character',
    ]);

           $image=$request->file('image');
        foreach($image as $image){
          /*   $name_gen=Str::random(5);
             $img_ext=$image->getClientOriginalExtension();
             $img_name= $name_gen.'.'.$img_ext;
             dd( $img_name);
             $up_location='images/multi/';
             //$last_img=$up_location.$img_name;
    
             $image->move(assset($up_location,$img_name)); */

           $name_gen=hexdec(uniqid());
            $img_ext=Strtolower($image->getClientOriginalExtension());
            $img_name=$name_gen.'.'.$img_ext;
             $up_location='images/multi/';
            $last_img=$up_location.$img_name;
            $image->move($up_location,$img_name); 

            Multipicture::insert([
                 'image'=>$last_img,
                 'created_at'=>Carbon::now(),
           ]);
   }
           return redirect()->back()->with('success', 'Image Added Successfully');

        
   }
   function logout(){
       Auth::logout();
       return redirect()->route('login')->with('user', 'Logout Successfully');
   }
}
