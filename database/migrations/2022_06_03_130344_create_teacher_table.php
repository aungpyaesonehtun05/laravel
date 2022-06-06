<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->length(11)->nullable(false);
            $table->string('name',255)->nullable(false);
            $table->string('father_name',255)->nullable();
            $table->string('nrc_number',40)->nullable();
            $table->string('phone_no',30)->nullable();
            $table->string('email',255)->nullable(false);
            $table->tinyInteger('gender')->length(3)->nullable(false)->comment('1 for male, 2 for female');
            $table->date('date_of_birth')->nullable();
            $table->string('avatar',255)->nullable();
            $table->string('address',500)->nullable();
            $table->tinyInteger('carrer_path')->length(3)->nullable()->comment('1 for FrontEnd, 2 for BackEnd')->default('1');
            $table->softDeletes(); 
            $table->integer('created_emp')->length(11)->nullable(false);
            $table->integer('updated_emp')->length(11)->nullable(false);
            // $table->timestamp('created-at')->useCurrent();
            // $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher');
    }
}
