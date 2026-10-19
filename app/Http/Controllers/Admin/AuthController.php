<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        if (session('admin_id')) return redirect()->route('admin.dashboard');
        return view('admin.auth.login');
    }
    public function login(Request $request) {
        $data = $request->validate(['email'=>'required|email','password'=>'required|string']);
        $admin = AdminUser::where('email',$data['email'])->first();
        if (!$admin || !Hash::check($data['password'],$admin->password)) {
            return back()->withErrors(['email'=>'Email atau password tidak sesuai.'])->onlyInput('email');
        }
        $request->session()->regenerate();
        session(['admin_id'=>$admin->id,'admin_name'=>$admin->name]);
        return redirect()->route('admin.dashboard');
    }
    public function logout(Request $request) {
        $request->session()->forget(['admin_id','admin_name']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success','Anda berhasil keluar.');
    }
}
