<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableBlockGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `block_groups` CHANGE `blockable_type` `block_groupable_type` varchar(255) NULL ;");
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `block_groups` CHANGE `blockable_id` `block_groupable_id` bigint(20) NULL ;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("block_groups", function (Blueprint $table){
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `block_groups` CHANGE  `block_groupable_type` `blockable_type` varchar(255) NULL ;");
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `block_groups` CHANGE  `block_groupable_id` `blockable_id` bigint(20) NULL ;");
        });
    }
}
