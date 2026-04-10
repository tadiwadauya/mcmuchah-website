<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('category')->nullable()->after('icon');
            $table->string('group_name')->nullable()->after('category');
            $table->string('button_text')->nullable()->after('group_name');
            $table->string('button_link')->nullable()->after('button_text');
            $table->string('client_link')->nullable()->after('button_link');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'group_name',
                'button_text',
                'button_link',
                'client_link',
            ]);
        });
    }
};