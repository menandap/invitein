<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Undangan;

class UserDashboardController extends Controller
{
    public function undangan(){
        $undangans = Undangan::paginate(5);
        Paginator::useBootstrap();

        return view('dashboard-usr.undanganlist', compact('undangans'));
    }

    public function create(){
        $categories = Product_categories::all();
        return view('pages.admins.product.productcreate', compact('categories'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'product_name' => 'required|unique:products|max:100',
            'price' => 'required|numeric',
            'weight' => 'required|numeric|min:0',
        ]);

        $product = new Product;

        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_rate = 0;
        $product->weight = $request->weight;
        $product->save();

        $kategoridata = $request->category_id;
        foreach($kategoridata as $kategori){
            $category = new Product_category_details;
            $product_id = Product::orderBy('id','desc')->first()->id;
            $category->category_id = $kategori;
            $category->product_id = $product_id;
            $category->save();
        }

        $this->validate($request, [
            'files.*' => 'required',
        ]);
        
        $id = Product::orderBy('id','desc')->first()->id;       
        if($id){
            $files = [];
            foreach($request->file('files') as $file){
                if($file->isValid()){
                    $nama_image = time()."_".$file->getClientOriginalName();
                    Storage::putFileAs('public', $file, $nama_image);
                    $files[] = [
                        'product_id' => $id,
                        'image_name' => 'storage/' . $nama_image,
                    ];
                }
            }
            Product_images::insert($files);
        }

        return Redirect::to('/admin/products')->with(['success' => 'Berhasil menambahkan produk']);
    }

    public function edit($id){
        $category = Product_categories::all();
        $categoryDetail = DB::table('product_category_details')
            ->select('category_id')
            ->where('product_id', '=', $id)->get();
        $products = Product::find($id); 
        // $discount = Discount::all();
        // dd($discount);
        return view('pages.admins.product.productedit', compact('category','categoryDetail','products'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[            
            'price' => 'required|numeric',
            'weight' => 'required|numeric|min:0',
        ]);

        $update = [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'weight' => $request->weight,
        ];
        Product::where('id', $id)->update($update);

        Product_category_details::where('product_id','=',$id)->delete();
        $kategoridata = $request->category_id;
        foreach($kategoridata as $category){
            $categoryDetail = new Product_category_details;
            $categoryDetail->product_id = $id;
            $categoryDetail->category_id = $category;
            $categoryDetail->save();
        }

        $discount = new Discounts;
        $discount->percentage = $request->percentage;
        $discount->product_id = $id;
        $discount->start = $request->start;
        $discount->end = $request->end;
        if(!empty($request->percentage)) {
            $discount->save();    
        }
        
        return Redirect::to('/admin/products')->with(['success' => 'Berhasil mengedit produk']);
    }

    public function delete($id){
        Product_category_details::where('product_id',$id)->delete();
        // Discounts::where('id_product',$id)->delete();
        Product_images::where('product_id',$id)->delete();
        Product::where('id', $id)->delete();

        return Redirect::to('/admin/products')->with(['error' => 'Berhasil menghapus produk']);
    }

    public function show($id){
        // $where = array('undangans.id' => $id);
        $undangans = Undangan::where('id', '=', $id)->first();
        // $image = DB::table('products')
        //     ->join('product_images', 'products.id', '=', 'product_images.product_id')
        //     ->select('product_images.*')
        //     ->where($where)->get();
        // return $undangans;
        //dd($undangans->title);
        return view('dashboard-usr.undangandetail', compact('undangans'));
    }

}
