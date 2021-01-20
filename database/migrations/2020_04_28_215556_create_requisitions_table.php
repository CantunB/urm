<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio');
            $table->timestamp('added_on');
            $table->string('management')->nullable();
            $table->string('administrative_unit')->nullable();
            $table->timestamp('required_on')->nullable();
            $table->mediumText('issue')->nullable();
            $table->string('remark')->nullable();
            $table->string('file_req')->nullable();
            // $table->longText('file_req')->nullable();
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('requisitions');
    }
}
