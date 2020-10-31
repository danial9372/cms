<?php

use Cyaxaress\Faq\Models\Faq;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {

            $table->id();
            $table->text('question');
            $table->mediumText('answer');
            $table->enum('status', Faq::$statuses);
            $table->timestamps();


            $table->foreign('faq_category_id')->references('id')->on('faq_categories')->onDelete('SET NULL');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}
