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
        Schema::create('features', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('modul', false);
            $table->string('name', 50)->nullable()->unique();
            $table->string('desc', 100)->nullable()->default('Default deskriptions for deatures');
            $table->unsignedBigInteger('created_by')->nullable(false)->comment('Foreign to users')->default(1);
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('modul')->references('id')->on('modul');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
};
