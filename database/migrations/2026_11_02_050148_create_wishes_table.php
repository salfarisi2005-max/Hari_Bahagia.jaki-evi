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
        if (Schema::hasTable('wishes')) {
            Schema::table('wishes', function (Blueprint $table) {
                if (! Schema::hasColumn('wishes', 'guest_id')) {
                    $table->foreignId('guest_id')->nullable()->constrained()->nullOnDelete();
                }

                if (! Schema::hasColumn('wishes', 'category')) {
                    $table->string('category', 40)->default('lainnya');
                }

                $table->index(['category', 'created_at']);
            });

            return;
        }

        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->nullable()->constrained()->nullOnDelete();
            $table->string('category', 40);
            $table->string('name', 100);
            $table->text('message');
            $table->timestamps();

            $table->index(['category', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('wishes')) {
            return;
        }

        Schema::table('wishes', function (Blueprint $table) {
            if (Schema::hasColumn('wishes', 'category')) {
                $table->dropIndex(['category', 'created_at']);
                $table->dropColumn('category');
            }

            if (Schema::hasColumn('wishes', 'guest_id')) {
                $table->dropForeign(['guest_id']);
                $table->dropColumn('guest_id');
            }
        });
    }
};
