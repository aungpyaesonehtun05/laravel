<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_skills', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->length(11)->nullable(false);
            $table->integer('skill_id')->length(11)->nullable(false);
            $table->softDeletes(); 
            $table->integer('created_emp')->length(11)->nullable(false);
            $table->integer('updated_emp')->length(11)->nullable(false);
            $table->timestamp('created-at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_skills');
    }
}
