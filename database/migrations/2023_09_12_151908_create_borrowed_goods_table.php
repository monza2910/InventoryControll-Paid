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
        Schema::create('borrowed_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('good_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receipent_id');
            $table->integer('qty');
            $table->text('note')->nullable();
            $table->enum('type', ['internal', 'eksternal']);
            $table->dateTime('date_out')->nullable();
            $table->dateTime('date_back')->nullable();
            $table->enum('status', ['Dipinjam', 'Selesai']);
            $table->foreign('receipent_id')->references('id')->on('recipients')->onDelete('cascade');
            $table->foreign('good_id')->references('id')->on('goods')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowed_goods');
    }
};
