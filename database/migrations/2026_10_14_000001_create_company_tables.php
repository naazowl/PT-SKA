<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('admin_users',function(Blueprint $t){$t->id();$t->string('name');$t->string('email')->unique();$t->string('password');$t->timestamps();});
  Schema::create('company_profiles',function(Blueprint $t){$t->id();$t->string('company_name');$t->string('tagline');$t->longText('about');$t->string('address');$t->string('phone');$t->string('email');$t->string('whatsapp')->nullable();$t->longText('vision');$t->longText('mission');$t->timestamps();});
  Schema::create('products',function(Blueprint $t){$t->id();$t->string('name');$t->string('slug')->unique();$t->string('category')->nullable();$t->string('short_description');$t->longText('description');$t->string('image')->nullable();$t->boolean('is_featured')->default(false);$t->boolean('is_published')->default(true);$t->timestamps();});
  Schema::create('articles',function(Blueprint $t){$t->id();$t->string('title');$t->string('slug')->unique();$t->string('excerpt');$t->longText('content');$t->string('image')->nullable();$t->boolean('is_published')->default(true);$t->timestamp('published_at')->nullable();$t->timestamps();});
  Schema::create('galleries',function(Blueprint $t){$t->id();$t->string('title');$t->string('description')->nullable();$t->string('image');$t->date('event_date')->nullable();$t->timestamps();});
 }
 public function down(): void {Schema::dropIfExists('galleries');Schema::dropIfExists('articles');Schema::dropIfExists('products');Schema::dropIfExists('company_profiles');Schema::dropIfExists('admin_users');}
};
