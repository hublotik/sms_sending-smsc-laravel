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
        Schema::create('sended_sms', function (Blueprint $table) {
            $table->id();
            $table->string('sms_name')->nullable();
            $table->string('completion')->nullable();
            $table->text('serialized_users_ids')->nullable();
            $table->integer('success')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sended_sms');
    }
};
