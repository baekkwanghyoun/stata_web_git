<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('stats_steps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->bigInteger('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stats_steps');
    }
};
