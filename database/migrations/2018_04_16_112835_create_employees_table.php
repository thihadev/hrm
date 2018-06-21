<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->increments('id');
            $table->string('photo')->default('default.jpg');
            $table->string('name');
            $table->string('email');
            $table->string('gender');
            $table->string('nrc');
            $table->string('phone');
            $table->text('address');
            $table->date('dateofbirth');
            $table->integer('department_id')->unsigned();
            $table->integer('designation_id')->unsigned();
            $table->date('joined');
            $table->integer('salary');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        // $table->dropForeign('employees_department_id_foreign');
        // $table->dropForeign('employees_designation_id_foreign');
        Schema::dropIfExists('employees');
    }
}
