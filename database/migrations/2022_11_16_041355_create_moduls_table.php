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
        Schema::create('modul', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('menu', false);
            $table->string('name', 50)->nullable();
            $table->string('desc', 100)->nullable()->default('Default descriptions for modul');
            $table->unsignedBigInteger('created_by')->nullable(false)->comment('Foreign to users')->default(1);
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('menu')->references('id')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modul');
    }
};
