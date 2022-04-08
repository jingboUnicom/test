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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('subcategory_id')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('candidate_name')->nullable();
            $table->string('location')->nullable();
            $table->string('current_job_title')->nullable();
            $table->text('experience')->nullable();
            $table->text('skills')->nullable();
            $table->text('education')->nullable();
            $table->text('languages')->nullable();
            $table->string('photo')->nullable();
            $table->string('resume')->nullable();
            $table->string('cover_letter')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
};
