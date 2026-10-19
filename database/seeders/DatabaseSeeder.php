<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use App\Models\CompanyProfile;
use App\Models\Product;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
 public function run(): void {
  AdminUser::updateOrCreate(['email'=>'adminsolusika@gmail.com'],['name'=>'Administrator','password'=>Hash::make('AdminSolusi123!')]);
  CompanyProfile::firstOrCreate(['company_name'=>'PT Koneksi Solusi Anda'],[
   'tagline'=>'Menghubungkan ide, menghadirkan solusi.',
   'about'=>'PT Koneksi Solusi Anda membantu organisasi tumbuh melalui strategi digital, pengembangan website, dan dukungan teknologi yang andal. Kami memadukan pemahaman bisnis dengan teknologi agar setiap solusi terasa sederhana, efektif, dan terukur.',
   'address'=>'Jl. Raya Pajajaran No. 88 F, Kota Bogor 16153','phone'=>'(+62) 895-2300-6489','email'=>'halo@koneksisolusianda.co.id','whatsapp'=>'(+62) 838-2599-4129
',
   'vision'=>'Menjadi mitra teknologi terpercaya yang menghubungkan potensi bisnis dengan masa depan digital.',
   'mission'=>"Menghadirkan solusi digital yang tepat guna dan mudah digunakan.\\nMembangun hubungan kemitraan yang terbuka dan berkelanjutan.\\nMenjaga kualitas melalui inovasi, kolaborasi, dan pembelajaran."
  ]);
  $products=[
   ['name'=>'Website Company Profile','category'=>'Web Development','short_description'=>'Website profesional untuk memperkuat kredibilitas dan identitas bisnis.','description'=>'Kami merancang dan mengembangkan website company profile yang responsif, mudah dikelola, dan selaras dengan identitas brand. Termasuk struktur halaman, optimasi dasar, dan formulir kontak.'],
   ['name'=>'Aplikasi Web Bisnis','category'=>'Digital Solution','short_description'=>'Aplikasi web yang membantu proses kerja menjadi lebih efisien.','description'=>'Solusi aplikasi berbasis web sesuai alur bisnis, mulai dari dashboard internal, pengelolaan data, hingga sistem administrasi yang terstruktur.'],
   ['name'=>'Konsultasi & Dukungan IT','category'=>'IT Consulting','short_description'=>'Pendampingan teknologi untuk kebutuhan operasional bisnis.','description'=>'Kami membantu pemetaan kebutuhan, perencanaan implementasi, dan dukungan teknis agar investasi teknologi memberikan manfaat nyata.']
  ];
  foreach($products as $p){$p['slug']=Str::slug($p['name']);$p['is_featured']=true;$p['is_published']=true;Product::firstOrCreate(['slug'=>$p['slug']],$p);}
  $articles=[
   ['title'=>'Mengapa Website Profesional Penting untuk Bisnis','excerpt'=>'Website yang baik membantu calon pelanggan mengenal bisnis Anda dengan lebih percaya diri.','content'=>'Website merupakan titik temu digital antara bisnis dan calon pelanggan. Tampilan yang konsisten, informasi yang jelas, serta pengalaman mobile yang nyaman membantu membangun kepercayaan. Mulailah dari tujuan bisnis, susun informasi utama, dan pastikan pengunjung mudah menghubungi tim Anda.'],
   ['title'=>'Langkah Awal Transformasi Digital','excerpt'=>'Transformasi digital dimulai dari memahami proses dan masalah yang ingin diselesaikan.','content'=>'Transformasi digital bukan sekadar menggunakan teknologi baru. Petakan proses yang ada, tentukan prioritas, libatkan pengguna, lalu ukur hasilnya. Implementasi bertahap membantu tim belajar dan menjaga perubahan tetap terarah.'],
   ['title'=>'Tips Menyiapkan Konten Company Profile','excerpt'=>'Susun pesan, layanan, dan informasi kontak agar profil perusahaan lebih meyakinkan.','content'=>'Kenali audiens, jelaskan nilai yang ditawarkan, tampilkan layanan secara ringkas, dan gunakan foto yang relevan. Perbarui informasi kontak serta berita secara berkala agar website tetap berguna.']
  ];
  foreach($articles as $a){$a['slug']=Str::slug($a['title']);$a['is_published']=true;$a['published_at']=now();\App\Models\Article::firstOrCreate(['slug'=>$a['slug']],$a);}
 }
}
