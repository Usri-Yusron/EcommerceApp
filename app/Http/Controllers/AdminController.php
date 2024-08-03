<?php

namespace App\Http\Controllers;

// buat print pdf
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function view_category(){
        // ngambil data
        $data = Category::all();

        return view('admin.category', compact('data'));
    }

    // buat nambahin data kategori
    public function add_category(Request $request){
        $category = new Category;

        $category->category_name = $request->category;

        $category->save();
        // notif succes dari toastr
        toastr()->timeOut(10000)->closeButton()->success('Category added successfully.');

        return redirect()->back();
    }

    // buat delete kategory
    public function delete_category($id){
        $data = Category::find($id);

        $data->delete();
        // notif succes delete dari toastr
        toastr()->timeOut(10000)->closeButton()->warning('Category deleted successfully.');

        return redirect()->back();
    }

    // buat edit kategory
    public function edit_category($id){
        $data = Category::find($id);

        return view('admin.edit_category', compact('data'));
    }
    // buat save edit kategory
    public function update_category(Request $request, $id){
        $data = Category::find($id);

        $data->category_name = $request->category;

        $data->save();
        // notif edit succes dari toastr
        toastr()->timeOut(10000)->closeButton()->success('Category Updated successfully.');

        return redirect('/view_category');

    }

    // buat add product
    public function add_product(){
        $category = Category::all();
        return view('admin.add_product', compact('category'));
    }

    // buat save add product
    public function upload_product(Request $request){
        $data = new Product;

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->qty;
        $data->category = $request->category;

        // upload image
        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products', $imagename);

            $data->image = $imagename;
        }

        $data->save();
        // notif succes dari toastr
        toastr()->timeOut(10000)->closeButton()->success('Product added successfully.');
        
        return redirect()->back();
    }

    // buat view produk
    public function view_product(){
        // paginate buat bikin per page (dibatasi jumlah yang muncul nya)
        $product = Product::paginate(3);
        return view('admin.view_product', compact('product'));
    }

    // buat update product
    public function update_product($id){
        $data = Product::find($id);

        $category = Category::all();
        return view('admin.update_page', compact('data', 'category'));
    }

    // buat save edit product
    public function edit_product(Request $request, $id){
        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('products', $imagename);

            $data->image = $imagename;
        }

        $data->save();
        // notif edit succes dari toastr
        toastr()->timeOut(10000)->closeButton()->success('Product Updated successfully.');

        return redirect('view_product');
    }

    // buat delete produk
    public function delete_product($id){
        $data = Product::find($id);

        // hapus gambar dari folder public
        $image_path = public_path('products/'.$data->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        $data->delete();
        // notif succes delete dari toastr
        toastr()->timeOut(10000)->closeButton()->warning('Product deleted successfully.');
        return redirect()->back();
    }

    // buat search produk
    public function product_search(Request $request){
        $search = $request->search;
        
        // $product berdasarkan looping yg ada di view product
        $product = Product::where('title', 'LIKE', '%'.$search.'%')->
        orWhere('category', 'LIKE', '%'.$search.'%')->
        paginate(3);

        return view('admin.view_product', compact('product'));
    }

    // buat view order
    public function view_order(){
        $data = Order::all();
        return view('admin.order', compact('data'));
    }

    // buat on the way status
    public function on_the_way($id){
        $data = Order::find($id);

        $data->status = 'On the Way';

        $data->save();

        return redirect('view_order');
    }

    // buat delivered
    public function delivered($id){
        $data = Order::find($id);

        $data->status = 'Delivered';

        $data->save();

        return redirect('view_order');
    }

    // buat print pdf
    public function print_pdf($id){
        $data = Order::find($id);
        
        $pdf = Pdf::loadView('admin.invoice', compact('data'));
        return $pdf->download('invoice.pdf');
    }
}
