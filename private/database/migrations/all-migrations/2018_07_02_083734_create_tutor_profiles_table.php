<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('uuid', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries')->nullable();
            $table->enum('driving_license', ['0', '1'])->comment('0=no,1=yes');
            $table->enum('willing_travel', ['0', '1'])->comment('0=no,1=yes');
            $table->enum('work_in_uk', ['0', '1'])->comment('0=no,1=yes');
            $table->enum('speak_languages', ['0', '1'])->comment('0=no,1=yes');
            $table->text('language_id')->nullable();
            $table->enum('level_of_fluency', ['0', '1', '2'])->comment('0=Basic understanding,1=Semi-Fluent,2=fluent');
            $table->string('passport', 255)->nullable();
            $table->string('work_permit', 255)->nullable();
            $table->string('birth_certificate', 255)->nullable();
            $table->string('passport_no', 255)->nullable();
            $table->date('pass_start_Date')->nullable();
            $table->date('pass_expiry_date')->nullable();
            $table->string('permit_no', 255)->nullable();
            $table->date('permit_start_Date')->nullable();
            $table->date('permit_expiry_date')->nullable();
            $table->text('travel_location')->nullable();
            $table->enum('certificates', ['0', '1'])->comment('0=no,1=yes');
            $table->date('certificate_issued')->nullable();
            $table->enum('dbs_cert', ['0', '1'])->comment('0=no,1=yes');
            $table->date('cert_issued')->nullable();
            $table->enum('internet_update_service', ['0', '1'])->comment('0=no,1=yes');
            $table->string('dbs_certificate_no', 255)->nullable();
            $table->enum('organisations', ['0', '1'])->comment('0=no,1=yes');
            $table->enum('disabilities', ['0', '1'])->comment('0=no,1=yes');
            $table->enum('medical_conditions', ['0', '1'])->comment('0=no,1=yes');
            $table->string('cv', 255)->nullable();
            $table->string('dbs_cert_upload', 255)->nullable();
            $table->string('certificates_upload', 255)->nullable();
            $table->string('teaching_qual', 255)->nullable();
            $table->text('about')->nullable();
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
        Schema::dropIfExists('tutor_profiles');
    }
}
