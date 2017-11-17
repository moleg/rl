<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('idStudents');
            $table->ipAddress('IpAdress');
            $table->enum('OlympType',['Олимпиада','Головоломки']);
            $table->string('FirstName',20);
            $table->string('LastName',20);
            $table->string('Email',50);
            $table->integer('Class');
            $table->string('City',20);
            $table->string('School');
            $table->string('Teacher',40);
            $table->string('PhoneNumber');
            $table->string('LeadSource',50)->nullable();
            $table->boolean('Registration')->default(false);
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
        Schema::dropIfExists('students');
    }
}
