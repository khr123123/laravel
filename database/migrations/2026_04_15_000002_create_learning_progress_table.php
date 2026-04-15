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
        Schema::create('learning_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->integer('progress_percentage')->default(0); // 完成进度百分比
            $table->boolean('completed')->default(false); // 是否完成
            $table->integer('times_studied')->default(0); // 学习次数
            $table->timestamp('last_studied_at')->nullable(); // 最后学习时间
            $table->timestamps();
            
            // 确保用户和课程的组合唯一
            $table->unique(['user_id', 'lesson_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_progress');
    }
};
