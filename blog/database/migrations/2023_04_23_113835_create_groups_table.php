<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string("cover")->default('no-group-cover.jpg');
            $table->string("name",100);
            $table->boolean("privacy")->default(false);
            $table->decimal("key")->nullable();
            $table->foreignId("category_id")->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
