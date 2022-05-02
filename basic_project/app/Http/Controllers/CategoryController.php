<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
//use carbon;
use Illuminate\Support\carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class CategoryController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    function allcat(){
     /*    $data=DB::table('categories')
        ->join('users', 'categories.user_id', 'users.id')
        ->select('categories.*', 'users.name')
        ->latest()->paginate(5); */
       $data=Category::latest()->paginate(5);
       $truckData=Category::onlyTrashed()->latest()->paginate(3);
       //$data=DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('data','truckData'));
    }
    function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'unique:categories|max:20',
            
        ],
        [
            'category_name.required' => 'Please Input Category Name',
            //'category_name.max'      => 'Category less than 20 char',
            //'category_name.unique' => 'Please alreday added Category Name ',   
        ]);

  /*        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => carbon::now()

        ]);  */
       /*  $category= new category();
        $category->category_name=$request->category_name;
        $category->user_id=Auth::user()->id;
        $category->save(); */
       DB::table('categories')->insert([
            ['category_name'=> $request->category_name,
            'user_id'=>Auth::user()->id]
        ]);
        
        return redirect()->back()->with('success', 'Category Inserted Successfully');
    }
    function editdata($id){
      
       // $data=Category::find($id);
       $data=DB::table('categories')->where('id', $id)->first();
       
        return view('admin.category.edit', compact('data'));

    }
    function updatedata(Request $request, $id){
       DB::table('categories')->where('id', $id)->update([
        'category_name'=>$request->category_name,
        'user_id'=>Auth::User()->id,
       ]);

      /*   $update=Category::find($id)->update([
            'category_name'=>$request->category_name,
            'user_id'=>Auth::User()->id,
        ]); */
        return redirect()->route('all.category')->with('success', 'Category Updated Successfully');

    }
    function deletedata($id){
       $delete= Category::find($id)->delete();
       return redirect()->back()->with('success', 'Category SOftdelete successfully');

    }

   function restoreData($id){
      
       $restore=Category::withTrashed()->find($id)->restore();
       return redirect()->back()->with('success', 'Category Restore successfully');
   }
   function pdeleteData($id){
      
    $restore=Category::onlyTrashed()->find($id)->forceDelete();
    return redirect()->back()->with('success', 'Category Parmanent Delete successfully');
}

}
