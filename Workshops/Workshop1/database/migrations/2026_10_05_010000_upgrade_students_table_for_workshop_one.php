<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (! Schema::hasColumn('students', 'phone')) {
                $table->string('phone')->default('')->after('email');
            }

            if (! Schema::hasColumn('students', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }

            if (! Schema::hasColumn('students', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('address');
            }

            if (Schema::hasColumn('students', 'age')) {
                $table->integer('age')->default(0)->change();
            }
        });

        if (! Schema::hasIndex('students', ['email'], 'unique')) {
            Schema::table('students', function (Blueprint $table) {
                $table->unique('email');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasIndex('students', ['email'], 'unique')) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropUnique(['email']);
            });
        }

        Schema::table('students', function (Blueprint $table) {
            $columns = array_filter(
                ['phone', 'address', 'date_of_birth'],
                fn (string $column): bool => Schema::hasColumn('students', $column),
            );

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
