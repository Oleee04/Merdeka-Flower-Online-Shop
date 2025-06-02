<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('customer_id'); 
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('noresi')->nullable(); 
            $table->string('kurir')->nullable(); 
            $table->integer('biaya_ongkir')->default(0);
            $table->string('alamat_tujuan')->nullable();
            $table->string('kode_kota')->nullable();
            $table->string('layanan_ongkir')->nullable(); 
            $table->string('estimasi_ongkir')->nullable(); 
            $table->string('estimasi_pengiriman')->nullable();
            $table->integer('total_berat')->nullable(); 
            $table->double('total_harga'); 
            $table->text('alamat')->nullable(); 
            $table->string('hp')->nullable(); // dipindah langsung setelah alamat
            $table->string('pos')->nullable(); 
            $table->string('status')->default('pending'); // status order
            $table->string('payment_type')->nullable();   // jenis pembayaran (midtrans)
            $table->string('transaction_id')->nullable(); // id transaksi midtrans
            $table->timestamps(); 

            // Foreign keys
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade'); 
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
