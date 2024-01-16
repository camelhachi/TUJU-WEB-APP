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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('roomNumber');
            $table->string('outletName', 255)->nullable();
            $table->decimal('maxOccupancy', 6, 2);
            $table->string('roomType', 255)->nullable();
            $table->decimal('roomPrice', 6, 2); 
            $table->decimal('roomStatus', 6, 2); 
            $table->string('image', 255)->nullable();                     
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};