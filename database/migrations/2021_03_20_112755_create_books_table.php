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
            $table->unsignedBigInteger('author_id');     //foreign key author
            $table->unsignedBigInteger('category_id');  //foreign key category
            $table->string('title');
            $table->string('isbn');
            $table->longText('description');
            $table->integer('year');
            $table->integer('nb_pages');
            $table->boolean('availability');
            $table->string('cover');
            $table->timestamps();

            //one to many  with author Table
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onDelete('cascade');

            //one to many with categry table
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
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
