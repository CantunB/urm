<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NoEmpleado');
            $table->string('name');
            $table->string('no_seg_soc');
            $table->string('categoria');
            $table->string('coordinacion');
            $table->string('depto')->nullable();
            $table->string('nivel')->nullable();
            $table->string('rfc')->nullable();
            $table->string('curp')->nullable();
            $table->string('fe_nacimiento')->nullable();
            $table->string('fe_ingreso')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->default('$2y$10$MPnTD/M.2EGZzHbnRQafd.yUG.3bWAUi5d9dzfX/6PXOX0J4.hv/C');
            $table->tinyInteger('status')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
