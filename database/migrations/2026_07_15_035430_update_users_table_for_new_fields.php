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
        Schema::table('users', function(Blueprint $table){

        $table->renameColumn('name','first_name');
        $table->renameColumn('username', 'email');

        $table->string('last_name')->after('first_name');
        $table->string('phone')->nullable()->after('email');
        $table->string('team')->nullable()->after('role');
        $table->text('notes')->nullable()->after('team');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table){
        $table->renameColumn('first_name','name');
        $table->renameColumn('email','username');
        $table->dropColumn(['last_name', 'phone', 'team', 'notes']);
        });
    }
};
