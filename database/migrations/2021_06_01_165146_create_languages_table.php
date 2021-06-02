<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->float('rating')->default(0.0);
            $table->enum('speaking', [ "Beginner", "Limited working proficiency", "Intermediate", "Proficient", "Fluent", "Native"])->default("Beginner");
            $table->enum('reading', [ "Beginner", "Limited working proficiency", "Intermediate", "Proficient", "Fluent", "Native"])->default("Beginner");
            $table->enum('writing', [ "Beginner", "Limited working proficiency", "Intermediate", "Proficient", "Fluent", "Native"])->default("Beginner");
            $table->enum('listening', [ "Beginner", "Limited working proficiency", "Intermediate", "Proficient", "Fluent", "Native"])->default("Beginner");
            $table->string('certificate_level')->nullable();
            $table->string('certificate_img_path')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('languages');
    }
}
