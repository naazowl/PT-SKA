<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index() { return view('admin.products.index',['items'=>Product::latest()->paginate(10)]); }
    public function create() { return view('admin.products.form',['item'=>new Product(),'action'=>route('admin.produk.store'),'method'=>'POST']); }
    public function store(Request $request) {
        $data=$this->validated($request);
        $data['is_published']=$request->boolean('is_published'); $data['is_featured']=$request->boolean('is_featured');
        if($request->hasFile('image')) $data['image']=$request->file('image')->store('products','public');
        $data['slug']=Str::slug($data['name']).'-'.Str::lower(Str::random(5));
        Product::create($data);
        return redirect()->route('admin.produk.index')->with('success','Produk berhasil ditambahkan.');
    }
    public function edit(Product $product) { return view('admin.products.form',['item'=>$product,'action'=>route('admin.produk.update',$product),'method'=>'PUT']); }
    public function update(Request $request, Product $product) {
        $data=$this->validated($request);
        $data['is_published']=$request->boolean('is_published'); $data['is_featured']=$request->boolean('is_featured');
        if($request->hasFile('image')) { if($product->image) Storage::disk('public')->delete($product->image); $data['image']=$request->file('image')->store('products','public'); }
        $data['slug']=Str::slug($data['name']).'-'.$product->id;
        $product->update($data);
        return redirect()->route('admin.produk.index')->with('success','Produk berhasil diperbarui.');
    }
    public function destroy(Product $product) { if($product->image) Storage::disk('public')->delete($product->image); $product->delete(); return back()->with('success','Produk berhasil dihapus.'); }
    private function validated(Request $r): array { return $r->validate(['name'=>'required|string|max:150','category'=>'nullable|string|max:100','short_description'=>'required|string|max:255','description'=>'required|string','image'=>'nullable|image|max:3072','is_featured'=>'nullable|boolean','is_published'=>'nullable|boolean']); }
}
