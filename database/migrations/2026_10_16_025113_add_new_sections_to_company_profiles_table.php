<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->string('profile_hero_title')->nullable();
            $table->string('profile_hero_highlight')->nullable();
            $table->text('profile_hero_description')->nullable();

            for ($i = 1; $i <= 3; $i++) {
                $table->string("profile_point_{$i}_title")->nullable();
                $table->text("profile_point_{$i}_description")->nullable();
            }

            for ($i = 1; $i <= 4; $i++) {
                $table->string("profile_value_{$i}_title")->nullable();
                $table->text("profile_value_{$i}_description")->nullable();
            }

            for ($i = 1; $i <= 4; $i++) {
                $table->string("profile_commitment_{$i}_title")->nullable();
                $table->text("profile_commitment_{$i}_description")->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'profile_hero_title',
                'profile_hero_highlight',
                'profile_hero_description',

                'profile_point_1_title',
                'profile_point_1_description',
                'profile_point_2_title',
                'profile_point_2_description',
                'profile_point_3_title',
                'profile_point_3_description',

                'profile_value_1_title',
                'profile_value_1_description',
                'profile_value_2_title',
                'profile_value_2_description',
                'profile_value_3_title',
                'profile_value_3_description',
                'profile_value_4_title',
                'profile_value_4_description',

                'profile_commitment_1_title',
                'profile_commitment_1_description',
                'profile_commitment_2_title',
                'profile_commitment_2_description',
                'profile_commitment_3_title',
                'profile_commitment_3_description',
                'profile_commitment_4_title',
                'profile_commitment_4_description',
            ]);
        });
    }
};