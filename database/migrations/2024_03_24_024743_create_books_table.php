<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->string('author', 64);
            $table->string('publisher', 64);
            $table->date('publication_date');
            $table->string('number_of_pages', 4);
            $table->float('heavy');
            $table->float('wide');
            $table->float('long');
            $table->string('languange', 128);
            $table->string('isbn', 64);
            $table->integer('stocks')->default(0);
            $table->integer('borrowed')->default(0);
            $table->integer('booked')->default(0);
            $table->string('image')->default('default-cover.jpg');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
