<?php

use Cyaxaress\Menu\Models\Menu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {

            $table->id();
            $table->float('priority')->nullable();
            $table->string('title', 70);
            $table->string('slug', 70);
            $table->enum('status', Menu::$statuses);
            $table->enum('position', Menu::$positions);
            $table->enum('target', Menu::$targets);
            $table->bigInteger('parent_id')->unsigned()->nullable();

            $table->foreign('parent_id')
                ->references('id')->on('menus')->onDelete('SET NULL');

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
        Schema::dropIfExists('Menus');
    }
}
