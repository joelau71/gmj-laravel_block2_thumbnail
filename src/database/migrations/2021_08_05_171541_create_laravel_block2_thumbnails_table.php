<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelBlock2ThumbnailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_block2_thumbnails', function (Blueprint $table) {
            $table->id();
            $table->foreignId("element_id")->constrained("elements")->onDelete("cascade");
            $table->longText("title")->nullbale();
            $table->integer("display_order");
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
        Schema::dropIfExists('laravel_block2_thumbnails');
    }
}
