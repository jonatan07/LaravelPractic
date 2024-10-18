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
        Schema::create('Teachers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("lastName");
            $table->timestamps();
        });

        Schema::create('Schools', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->timestamps();
        });

        Schema::create('Classrooms', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("chairsAvailable");
            $table->foreignId("school_id")->references("id")->on("Schools")->constrained()->onDelete('cascade');
            $table->foreignId("teacher_id")->references("id")->on("Teachers")->constrained()->onDelete('cascade');;
            $table->timestamps();
        });
        Schema::create('StudentClassroom', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->references("id")->on("Students")->constrained()->onDelete('cascade');
            $table->foreignId("classroom_id")->references("id")->on("Classrooms")->constrained()->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Teachers');
        Schema::dropIfExists('Schools');
        Schema::dropIfExists('Classrooms');
        Schema::dropIfExists('StudentClassroom');
    }
};
