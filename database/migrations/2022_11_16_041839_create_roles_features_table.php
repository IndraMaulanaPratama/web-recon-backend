<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles_features', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('feature', false);
            $table->integer('role', false);
            $table->timestamps();

            $table->foreign('feature')->references('id')->on('features');
            $table->foreign('role')->references('id')->on('roles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles_features');
    }
};
