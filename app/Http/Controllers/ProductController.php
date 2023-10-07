<?php
//https://www.youtube.com/watch?v=1oGrDyFp9X8
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(){
        $products=Product::latest()->paginate(5);
        return view('products.index',['products'=>$products]);
    }

    //create the products 
    public function create(){
        return view('products.create');
    }
    //save the data
    public function store(Request $request){

        //validate data
        $request->validate([
            'name'  => 'required',
            'description'  => 'required',
            'image'  => 'required|mimes:jpeg,jpg,png,gif|max:1000',
        ]);
        // return view('products.create');
       //dd($request->all());
       //upload image 
       $imageName=time().'.'.$request->image->extension();
       $request->image->move(public_path('products'),$imageName);

       $product=new Product;
       $product->image=$imageName;
       $product->name=$request->name;
       $product->description=$request->description;
       $product->save();
       return back()->withSuccess('Product Created !!!!');
       //dd($imageName);
    }
    //edit 
    public function edit($id){
        $product = Product::where('id',$id)->first();
        //dd($product);
        return view('products.edit',['products'=>$product]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'  => 'required',
            'description'  => 'required',
            'image'  => 'nullable|mimes:jpeg,jpg,png,gif|max:1000',
        ]);
        $product = Product::where('id',$id)->first();
        if(isset($request->image)){
            $imageName=time().'.'.$request->image->extension();
            $request->image->move(public_path('products'),$imageName);
            $product->image=$imageName;
        }
       //upload image 
       
       $product->name=$request->name;
       $product->description=$request->description;
       $product->save();
       return back()->withSuccess('Product Updated !!!!');
    }

    public function destroy($id){
        $product= Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Product Deteled !!!!');
    }

    public function show($id){
        $product= Product::where('id',$id)->first();
        return view('products.show',['products'=>$product]);
        //return back()->withSuccess('Product Deteled !!!!');
    }
}
