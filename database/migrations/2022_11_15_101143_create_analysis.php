<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('analyses', function (Blueprint $table) {
            $table->id();
            $table->char('type', 10);
            $table->text('value');
            $table->timestamps();
            $table->index('type');
        });
    }
};
