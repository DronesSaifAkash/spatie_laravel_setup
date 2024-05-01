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
        Schema::create('tbl_moment', function (Blueprint $table) {
            $table->id('momentid');
            $table->unsignedBigInteger('userId');
            $table->tinyInteger('isBusinessMoment')->default(0);
            $table->unsignedBigInteger('businessId')->nullable();
            $table->string('heading');
            $table->longText('description')->nullable();
            $table->string('permalink', 210);
            $table->string('imageName', 244)->nullable();
            $table->enum('comment', ['Y', 'N'])->default('N');
            $table->enum('ispublic', ['Y', 'N'])->default('N');
            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();
            $table->integer('distance')->default(0);
            $table->string('publishTime')->nullable();
            $table->string('selfDestruct')->default('9999-01-10 10:01:10');
            $table->longText('shareemail')->nullable();
            $table->longText('sharephone')->nullable();
            $table->string('promourl', 210)->nullable();
            $table->integer('display_order')->default(5);
            $table->enum('flag', ['Y', 'N'])->default('N');
            $table->string('reason', 255)->nullable();
            $table->enum('status', ['Y', 'N'])->default('Y');
            $table->timestamp('entryDate')->useCurrent();
            $table->string('position', 9)->nullable();
            $table->timestamps();
            
            // Foreign key constraint for userId
            // $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            
            // Foreign key constraint for businessId
            // $table->foreign('businessId')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_moment');
    }
};
