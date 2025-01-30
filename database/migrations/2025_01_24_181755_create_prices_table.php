<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracking_id')->constrained('trackings')->onDelete('cascade');
            $table->string('url');
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
