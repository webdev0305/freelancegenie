<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_logo', 255)->nullable();
            $table->string('company_name', 255)->nullable();
            $table->text('company_address')->nullable();
            $table->string('contact_tel', 255)->nullable();
            $table->string('head_office_address', 255)->nullable();
            $table->string('authorised_user', 255)->nullable();
            $table->string('authorised_user_second', 255)->nullable();
            $table->string('contact_person', 255)->nullable()->nullable();
            $table->string('head_office_contact_person', 255)->nullable()->nullable();
            $table->string('contact_person_second', 255)->nullable()->nullable();
            $table->string('head_office_contact_person_second', 255)->nullable();
            $table->string('dept', 255)->nullable();
            $table->string('dept_second', 255)->nullable();
            $table->string('contact_no', 255)->nullable();
            $table->string('contact_no_second', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('email_second', 255)->nullable();
            $table->string('company_reg_no', 255)->nullable();
            $table->enum('different_locations', ['0', '1'])->comment('0=no,1=yes')->nullable();;
            $table->text('address')->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->integer('country_id')->unsigned()->nullable();;
            $table->foreign('country_id')->references('id')->nullable()->on('countries')->nullable();;
            $table->enum('onsite_projector', ['0', '1'])->comment('0=no,1=yes')->nullable();;
            $table->enum('wipe_board', ['0', '1'])->comment('0=no,1=yes')->nullable();;
            $table->enum('flip_chart_and_stand', ['0', '1'])->comment('0=no,1=yes')->nullable();;
            $table->enum('disabilities', ['0', '1'])->comment('0=no,1=yes')->nullable();;
            $table->enum('equipment_available', ['0', '1'])->comment('0=no,1=yes')->nullable();;
            $table->enum('equipment_available_onsite', ['0', '1'])->comment('0=no,1=yes')->nullable();;
            $table->string('report_name', 255)->nullable()->nullable();;
            $table->string('report_department', 255)->nullable()->nullable();;
            $table->string('company_vat_reg_no', 255)->nullable()->nullable();;
            $table->string('additional_information', 255)->nullable()->nullable();;
            $table->string('additional_details', 255)->nullable()->nullable();;
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
        Schema::dropIfExists('employer_profiles');
    }
}
