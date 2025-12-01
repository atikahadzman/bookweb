<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // $table->unsignedBigInteger('updated_by')->nullable()->after('status');
            // $table->timestamp('approved_at')->nullable()->after('updated_by');

            // Optional: foreign key to users table
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        //
    }
};
