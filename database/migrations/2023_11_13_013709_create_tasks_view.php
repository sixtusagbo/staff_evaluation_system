<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW view_tasks AS
        SELECT *,
        (
            CASE
                WHEN deadline < NOW() THEN 2
                WHEN started_on < NOW() AND deadline > NOW() THEN 1
                WHEN started_on > NOW() THEN 0
                ELSE NULL
            END
        ) as status
        FROM tasks
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_tasks");
    }
};
