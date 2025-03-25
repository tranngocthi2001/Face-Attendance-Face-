<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('attendance', function (Blueprint $table) {
        $table->id();
        $table->date('time');
        $table->integer('status');
        $table->string('capture_image')->nullable();
        $table->foreignId('subject_id')->constrained('subject')->onDelete('cascade');
        $table->foreignId('student_id')->constrained('student')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
