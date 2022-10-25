<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('allow_ips', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->ipAddress('ip');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('allow_ips');
    }
};
