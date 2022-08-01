<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacao', function (Blueprint $table) {
            $table->id();
            $table->double('valor')->default(0);
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('conta_id');
            $table->unsignedBigInteger('pessoa_id');
            $table->foreign('conta_id')->references('id')->on('conta');
            $table->foreign('pessoa_id')->references('id')->on('pessoa');
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
        Schema::dropIfExists('movimentacao');
    }
};
