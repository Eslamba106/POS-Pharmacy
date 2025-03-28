<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('company_id', 255)->unique()->index();
            $table->string('user_name', 255)->unique();
            $table->string('email', 255)->nullable();
            $table->string('domain', 500)->nullable();
            $table->string('password', 255); 
            $table->unsignedInteger('user_count')->default(1);
            $table->unsignedInteger('branches_count')->default(1);
            $table->string('setup_cost')->nullable();
            $table->string('creation_date', 255)->nullable(); 
            $table->string('currency', 15)->nullable(); 
            $table->string('currency_code', 255)->nullable(); 
            $table->string('decimals', 255)->nullable();
            $table->text('address1')->nullable(); 
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable(); 
            $table->string('phone', 15)->nullable();
            $table->string('logo', 255)->nullable(); 
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->string('my_name', 255)->nullable(); 
            $table->json('database_options')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
