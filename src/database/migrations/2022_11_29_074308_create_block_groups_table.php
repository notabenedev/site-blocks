<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_groups', function (Blueprint $table) {
            $table->id();

            $table->string("title");

            $table->string("slug")
                ->unique();

            $table->string("template")
                ->comment("blade template");

            $table->unsignedBigInteger("priority")
                ->default(0)
                ->comment('Приоритет');

            $table->nullableMorphs('blockable');

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
        Schema::dropIfExists('block_groups');
    }
}
