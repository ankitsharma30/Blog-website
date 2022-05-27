<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $posts=Post::all();
        return view('admin.post.index',compact('posts'));
    }

    public function create()
    {
        $category=Category::where('status','0')->get();

        return view('admin.post.create',compact('category'));
    }
    public function store(Request $request){
        $data = $request->validate([

            'category_id'=>[
                'integer',
                'required',
                
            ],

            'name'=>[
                'required',
                'string',
            ],


            'slug'=>[
             'required',
             'string',
             'max:200',
              ],


              'description'=>[
                 'required',
                 
             ],
             'yt_iframe'=>[
                 'nullable',
                 'string'
             ],
             'meta_title'=>[
                 'required',
                 'string',
                 'max:200',
              ],
              'meta_description'=>[
                     'nullable',
                     'string',
                     
              ],
              'meta_keyword'=>[
                 'required',
                 'string',
                 
              ],

                 
             'status'=>[
                 'nullable',
               
                  ],
        ]);

        $post= new Post();
        $post->category_id=$data['category_id'];
        $post->name=$data['name'];
        $post->slug=$data['slug'];
        $post->description=$data['description'];
        $post->yt_iframe=$data['yt_iframe'];
        $post->meta_title=$data['meta_title'];
        $post->meta_description=$data['meta_description'];
        $post->meta_keyword=$data['meta_keyword'];
       
        $post->status=$request->status==true ? '1' : '0';
        $post->created_by=Auth::user()->id;
        $post->save();
        return redirect('admin/posts')->with('message','Post Added Succesfully');

    }
    public function edit($post_id)
    {
        $post=Post::find($post_id);
        $category=Category::where('status','0')->get();
        return view('admin.post.edit',compact('post','category'));
    }
    public function update($post_id,Request $request){
           
        $data = $request->validate([

            'category_id'=>[
                'integer',
                'required',
                
            ],

            'name'=>[
                'required',
                'string',
            ],


            'slug'=>[
             'required',
             'string',
             'max:200',
              ],


              'description'=>[
                 'required',
                 
             ],
             'yt_iframe'=>[
                 'nullable',
                 'string'
             ],
             'meta_title'=>[
                 'required',
                 'string',
                 'max:200',
              ],
              'meta_description'=>[
                     'nullable',
                     'string',
                     
              ],
              'meta_keyword'=>[
                 'required',
                 'string',
                 
              ],

                 
             'status'=>[
                 'nullable',
               
                  ],
        ]);

        $post= Post::find($post_id);
        $post->category_id=$data['category_id'];
        $post->name=$data['name'];
        $post->slug=$data['slug'];
        $post->description=$data['description'];
        $post->yt_iframe=$data['yt_iframe'];
        $post->meta_title=$data['meta_title'];
        $post->meta_description=$data['meta_description'];
        $post->meta_keyword=$data['meta_keyword'];
       
        $post->status=$request->status==true ? '1' : '0';
        $post->created_by=Auth::user()->id;
        $post->update();
        return redirect('admin/posts')->with('message','Post Updated Succesfully');
    }
    public function destroy($post_id){
                $post=Post::find($post_id);
                $post->delete();
                return redirect('admin/posts')->with('message','Post deleted Succesfully');
    }
}
