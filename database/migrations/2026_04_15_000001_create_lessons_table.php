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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // 课程标题
            $table->text('description')->nullable(); // 课程描述
            $table->text('content'); // 课程内容
            $table->string('level')->default('beginner'); // 难度: beginner, intermediate, advanced
            $table->string('category')->default('vocabulary'); // 分类: vocabulary, grammar, phrasal_verbs等
            $table->integer('duration')->nullable(); // 学习时长(分钟)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
