<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();

            $table->string("title");

            $table->string("slug")
                ->unique();

            $table->string('main_image')
                ->nullable();

            $table->tinyText("short")
                ->nullable();

            $table->longText("description")
                ->nullable();

            $table->unsignedBigInteger("priority")
                ->default(0)
                ->comment('Приоритет');

            $table->unsignedBigInteger("block_group_id")
                ->comment("Группа блока");

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
        Schema::dropIfExists('blocks');
    }
}
