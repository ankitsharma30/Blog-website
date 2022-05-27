<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(){
        $category=Category::all();
        return view('admin.category.index',compact('category'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store( Request $request)
    {
        // dd($request);
        $data = $request->validate([

            'name'=>[
                'required',
                'string',
                'max:200',
            ],
            'slug'=>[
             'required',
             'string',
             'max:200',
              ],
              'description'=>[
                 'required',
                 
             ],
             'image'=>[
                 'required',
                 'image'
             ],
             'meta_title'=>[
                 'required',
                 'string',
                 'max:200',
              ],
              'meta_description'=>[
                     'required',
                     'string',
                     
              ],
              'meta_keywords'=>[
                 'required',
                 'string',
                 
              ],

                  'navbar_status'=>[
                     'nullable',
                     
             ],
             'status'=>[
                 'nullable',
               
                  ],
        ]);
            $category = new Category();
            $category->name=$data['name'];
            $category->slug=$data['slug'];
            $category->description=$data['description'];
            if($request->hasfile('image')){
                $file=$request->file('image');
                $filename=time().'.'. $file->getClientOriginalExtension();
                $file->move('uploads/category/',$filename);
                $category->image=$filename;
            }
            $category->meta_title=$data['meta_title'];
            $category->meta_description=$data['meta_description'];
            $category->meta_keywords=$data['meta_keywords'];
            $category->navbar_status=$request->navbar_status==true ? '1' : '0';
            $category->status=$request->status==true ? '1' : '0';
            $category->created_by=Auth::user()->id;
            $category->save();
            return redirect('admin/category')->with('message','Category Added Succesfully');


    }

    public function edit($category_id){
        $category= Category::find($category_id);
        return view('admin.category.edit',compact('category'));

    }

    public function update(Request $request ,$category_id)
    {
        
        $data = $request->validate([

            'name'=>[
                'required',
                'string',
                'max:200',
            ],
            'slug'=>[
             'required',
             'string',
             'max:200',
              ],
              'description'=>[
                 'required',
                 
             ],
             'image'=>[
                 'nullable',
                 'image'
             ],
             'meta_title'=>[
                 'required',
                 'string',
                 'max:200',
              ],
              'meta_description'=>[
                     'required',
                     'string',
                     
              ],
              'meta_keywords'=>[
                 'required',
                 'string',
                 
              ],

                  'navbar_status'=>[
                     'nullable',
                     
             ],
             'status'=>[
                 'nullable',
               
                  ],
        ]);
        $category = Category::find($category_id);
        $category->name=$data['name'];
        $category->slug=$data['slug'];
        $category->description=$data['description'];
        if($request->hasfile('image')){
            $destination='uploads/category/'.$category->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file=$request->file('image');
            $filename=time().'.'. $file->getClientOriginalExtension();
            $file->move('uploads/category/',$filename);
            $category->image=$filename;
        }
        $category->meta_title=$data['meta_title'];
        $category->meta_description=$data['meta_description'];
        $category->meta_keywords=$data['meta_keywords'];
        $category->navbar_status=$request->navbar_status==true ? '1' : '0';
        $category->status=$request->status==true ? '1' : '0';
        $category->created_by=Auth::user()->id;
        $category->update();
        return redirect('admin/category')->with('message','Category Updated Succesfully');

    }

    public function delete($category_id)
    {
        $category=Category::find($category_id);
        if($category)
        {
            $category->delete();
            return redirect('admin/category')->with('message','Category Delete Succesfully');
        }
        else
        {
            return redirect('admin/category')->with('message','No Category Id Found');

        }
    }
}
