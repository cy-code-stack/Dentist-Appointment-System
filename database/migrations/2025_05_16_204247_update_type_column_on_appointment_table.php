<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set the first NULL row to 'Online'
        $first = DB::table('appointment')
            ->whereNull('type')
            ->orderBy('id')
            ->first();

        if ($first) {
            DB::table('appointment')
                ->where('id', $first->id)
                ->update(['type' => 'Online']);
        }

        $second = DB::table('appointment')
            ->whereNull('type')
            ->orderBy('id')
            ->skip(1)
            ->first();

        if ($second) {
            DB::table('appointment')
                ->where('id', $second->id)
                ->update(['type' => 'Walk-in']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('appointment')
            ->whereIn('type', ['Online', 'Walk-in'])
            ->update(['type' => null]);
    }
};


