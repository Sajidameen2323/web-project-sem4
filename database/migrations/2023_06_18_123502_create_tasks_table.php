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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('state');
            $table->text('description');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('assigned_to');
            $table->string('priority');
            $table->integer('effort');
            $table->date('target_date');
            $table->string('risk');
            $table->string('type');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('project_id')
                ->references('project_id')
                ->on('projects')
                ->onDelete('cascade');

            $table->foreign('assigned_to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
