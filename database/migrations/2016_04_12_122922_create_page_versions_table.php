<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->integer('chapter_id');
            $table->string('title');
            $table->text('description');
            $table->text('content')->nullable();
            $table->string('slug');
            $table->boolean('has_resources')->default(false);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('page_versions');
    }
}
