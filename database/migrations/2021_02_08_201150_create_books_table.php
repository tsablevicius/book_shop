<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('author');
            $table->string('genre');
            $table->string('year');
            $table->decimal('price');
            $table->integer('discount')->nullable();
            $table->string('cover_img_path');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('is_confirmed')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
