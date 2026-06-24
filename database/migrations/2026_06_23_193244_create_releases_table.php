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
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('assignment_id')->constrained();
            $table->foreignId('employee_id')->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('payroll_number')->nullable();
            $table->bigInteger('department_id');
            $table->string('department_name');
            $table->string('username');
            $table->text('comments');
            $table->bigInteger('user_id');
            $table->string('user_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('releases');
    }
};
