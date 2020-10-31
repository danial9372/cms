<?php

 use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {

            $table->id();
            $table->string('title', 70);
            $table->longText('body');
            $table->string('slug', 70);
            $table->enum('status', \Cyaxaress\Page\Models\Page::$statuses);
            $table->foreign('banner_id')->references('id')->on('media')->onDelete('SET NULL');
            $table->string('meta_title', 70)->nullable();
            $table->string('meta_description', 200)->nullable();
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
        Schema::dropIfExists('pages');
    }
}
