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
            $table->string('avatar')->default('user.jpg');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->integer('age');
            $table->string('phone');
            $table->text('address');
            $table->date('dateofbirth');
            $table->integer('department_id')->unsigned();
            $table->integer('designation_id')->unsigned();
            // $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade')->onUpdate('cascade');
            $table->date('joined');
            $table->rememberToken();
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
        // $table->dropForeign('employees_department_id_foreign');
        // $table->dropForeign('employees_designation_id_foreign');
        Schema::dropIfExists('employees');
    }
}
