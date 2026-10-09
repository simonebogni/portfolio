<?php

declare(strict_types=1);

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
        Schema::create('work_positions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('company_id');
            $table->string('title');
            $table->string('period');
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->boolean('current');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_positions');
    }
};
