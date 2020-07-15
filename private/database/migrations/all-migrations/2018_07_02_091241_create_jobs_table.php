<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title', 255)->nullable();
            $table->enum('type', ['0', '1'])->comment('0=fixes,1=hourly')->nullable();
            $table->integer('rate')->nullable();
            $table->enum('status', ['0', '1', '2'])->comment('0=precess,1=accept,2=reject')->nullable();
            $table->integer('category_user_id')->unsigned();
            $table->foreign('category_user_id')->references('id')->on('category_user')->onDelete('cascade')->nullable();
            $table->text('description')->nullable();
            $table->string('file', 255)->nullable();
            $table->integer('qualified_levels_id')->unsigned();
            $table->foreign('qualified_levels_id')->references('id')->on('qualified_levels')->onDelete('cascade')->nullable();
            $table->integer('sub_disciplines_id')->unsigned();
            $table->foreign('sub_disciplines_id')->references('id')->on('disciplines')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
