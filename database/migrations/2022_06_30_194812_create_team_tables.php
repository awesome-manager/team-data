<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    private $tables = [
        'employees',
        'positions',
        'vacations',
        'grades',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                continue;
            }

            if (method_exists($this, $method = Str::camel("up_{$table}"))) {
                $this->{$method}();
            }
        }
    }

    private function upEmployees()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->uuid('position_id');
            $table->uuid('grade_id');
            $table->date('employment_at')->nullable();
            $table->date('probation')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    private function upPositions()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('code', 100)->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    private function upVacations()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('employee_id');
            $table->date('started_at');
            $table->date('ended_at');
            $table->timestamps();
        });
    }

    private function upGrades()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 100);
            $table->string('code', 100)->unique();
            $table->boolean('is_active')->default(true);
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
        foreach ($this->tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
