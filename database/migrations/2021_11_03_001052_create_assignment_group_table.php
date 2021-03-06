<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_group', function (Blueprint $table) {
            $table->foreignId('assignment_id')->constrained('assignments');
            $table->foreignId('group_id')->constrained('groups');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('finish_date')->nullable();
            $table->boolean('active')->default(FALSE);
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
        Schema::dropIfExists('assignment_group');
    }
}
