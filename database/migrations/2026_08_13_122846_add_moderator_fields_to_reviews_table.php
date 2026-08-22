// database/migrations/xxxx_xx_xx_add_moderator_fields_to_reviews_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Проверяем, существует ли колонка, и добавляем если нет
            if (!Schema::hasColumn('reviews', 'moderator_id')) {
                $table->unsignedBigInteger('moderator_id')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('reviews', 'moderated_at')) {
                $table->timestamp('moderated_at')->nullable()->after('approved');
            }

            if (!Schema::hasColumn('reviews', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('moderated_at');
            }

            // Добавляем внешний ключ для модератора (если его нет)
            try {
                $table->foreign('moderator_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
            } catch (\Exception $e) {
                // Если foreign key уже существует, игнорируем
            }
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['moderator_id']);
            $table->dropColumn(['moderator_id', 'moderated_at', 'rejection_reason']);
        });
    }
};