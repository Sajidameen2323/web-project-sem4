<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id');
            $table->string('project_name');
            $table->string('subtitle');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('project_manager');
            $table->unsignedBigInteger('team_lead');
            $table->string('status');
            $table->string('priority');
            $table->text('description');
            $table->string('frontend');
            $table->string('backend');
            $table->string('database');
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
        Schema::dropIfExists('projects');
    }
}
