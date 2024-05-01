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
        Schema::create('momentmarkar_v2', function (Blueprint $table) {
            $table->id();
            $table->integer('momentId');
            $table->string('Image', 250)->nullable();
            
            $table->string('media1_ios', 250)->nullable();
            $table->string('media1_android', 250)->nullable();
            $table->integer('media1_type')->default(0);
            $table->string('media1_chroma', 10)->nullable();

            $table->string('media2_ios', 250)->nullable();
            $table->string('media2_android', 250)->nullable();
            $table->integer('media2_type')->default(0);
            $table->string('media2_chroma', 10)->nullable();

            $table->string('media3_ios', 250)->nullable();
            $table->string('media3_android', 250)->nullable();
            $table->integer('media3_type')->default(0);
            $table->string('media3_chroma', 10)->nullable();

            $table->string('media4_ios', 250)->nullable();
            $table->string('media4_android', 250)->nullable();
            $table->integer('media4_type')->default(0);
            $table->string('media4_chroma', 10)->nullable();

            $table->string('media5_ios', 250)->nullable();
            $table->string('media5_android', 250)->nullable();
            $table->integer('media5_type')->default(0);
            $table->string('media5_chroma', 10)->nullable();

            $table->string('media6_ios', 250)->nullable();
            $table->string('media6_android', 250)->nullable();
            $table->integer('media6_type')->default(0);
            $table->string('media6_chroma', 10)->nullable();

            $table->string('winnerVideo', 200)->nullable();
            $table->string('winnerVisitors', 100)->nullable();
            $table->string('winnerMessage', 255)->nullable();
            $table->string('uniqueId', 210)->nullable();
            $table->dateTime('createDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('image_quality_score_t')->default(0);
            $table->integer('image_quality_score_m')->default(0);
            
            $table->enum('status', ['y', 'n'])->default('n');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('momentmarkar_v2');
    }
};
