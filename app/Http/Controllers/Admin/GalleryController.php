<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class GalleryController extends Controller
{
    public function index(){return view('admin.gallery.index',['items'=>Gallery::latest()->paginate(12)]);}
    public function create(){return view('admin.gallery.form',['item'=>new Gallery(),'action'=>route('admin.galeri.store'),'method'=>'POST']);}
    public function store(Request $r){$d=$this->validated($r);$d['image']=$r->file('image')->store('gallery','public');Gallery::create($d);return redirect()->route('admin.galeri.index')->with('success','Foto berhasil diunggah.');}
    public function edit(Gallery $gallery){return view('admin.gallery.form',['item'=>$gallery,'action'=>route('admin.galeri.update',$gallery),'method'=>'PUT']);}
    public function update(Request $r,Gallery $gallery){$d=$this->validated($r,false);if($r->hasFile('image')){if($gallery->image)Storage::disk('public')->delete($gallery->image);$d['image']=$r->file('image')->store('gallery','public');}$gallery->update($d);return redirect()->route('admin.galeri.index')->with('success','Foto diperbarui.');}
    public function destroy(Gallery $gallery){if($gallery->image)Storage::disk('public')->delete($gallery->image);$gallery->delete();return back()->with('success','Foto dihapus.');}
    private function validated(Request $r,bool $required=true):array{return $r->validate(['title'=>'required|string|max:160','description'=>'nullable|string|max:255','image'=>($required?'required':'nullable').'|image|max:5120','event_date'=>'nullable|date']);}
}
