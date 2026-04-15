@extends('layout')

@section('title', '学习仪表板 - 英语学习平台')

@section('content')
<!-- Welcome Header -->
<div class="mb-12">
    <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-2">👋 欢迎回来，{{ $user->name }}！</h1>
    <p class="text-lg text-slate-600 dark:text-slate-400">你的英语学习之旅</p>
</div>

<!-- Stats Grid -->
<div class="grid md:grid-cols-4 gap-6 mb-8">
    <!-- Total Lessons -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md p-6 border-l-4 border-indigo-600">
        <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">总课程数</p>
        <p class="text-4xl font-bold text-slate-900 dark:text-white">{{ $stats['total_lessons'] }}</p>
    </div>

    <!-- Completed -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md p-6 border-l-4 border-green-600">
        <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">已完成</p>
        <p class="text-4xl font-bold text-green-600">{{ $stats['completed_lessons'] }}</p>
    </div>

    <!-- Study Times -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md p-6 border-l-4 border-purple-600">
        <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">学习次数</p>
        <p class="text-4xl font-bold text-slate-900 dark:text-white">{{ $stats['total_study_time'] }}</p>
    </div>

    <!-- Completion Rate -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md p-6 border-l-4 border-orange-600">
        <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">完成进度</p>
        <p class="text-4xl font-bold text-slate-900 dark:text-white">
            @if($stats['total_lessons'] > 0)
                {{ round(($stats['completed_lessons'] / $stats['total_lessons']) * 100) }}%
            @else
                0%
            @endif
        </p>
    </div>
</div>

<!-- Learning Progress Section -->
@if($progress->count() > 0)
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span>📖</span>
                <span>你的学习进度</span>
            </h2>
        </div>

        <div class="divide-y divide-slate-200 dark:divide-slate-700">
            @foreach($progress as $item)
                <div class="p-6 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition duration-200">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <a 
                                href="{{ route('lessons.show', $item->lesson) }}" 
                                class="text-lg font-bold text-indigo-600 dark:text-indigo-400 hover:underline"
                            >
                                {{ $item->lesson->title }}
                            </a>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                {{ $item->lesson->description ?? '暂无描述' }}
                            </p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            @if($item->completed) 
                                bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                            @else 
                                bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                            @endif
                        ">
                            @if($item->completed) ✓ 已完成 @else 进行中 @endif
                        </span>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-3">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">完成度</span>
                            <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ $item->progress_percentage }}%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                            <div 
                                class="h-full bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300"
                                style="width: {{ $item->progress_percentage }}%"
                            ></div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid sm:grid-cols-3 gap-4 text-sm text-slate-600 dark:text-slate-400">
                        <div>
                            <span class="text-xs font-medium">学习次数</span>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $item->times_studied }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-medium">最后学习</span>
                            <p class="font-semibold text-slate-900 dark:text-white">
                                @if($item->last_studied_at)
                                    {{ $item->last_studied_at->diffForHumans() }}
                                @else
                                    未开始
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <a 
                                href="{{ route('lessons.show', $item->lesson) }}" 
                                class="inline-flex items-center gap-1 text-indigo-600 dark:text-indigo-400 hover:underline font-semibold"
                            >
                                继续学习
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <!-- Empty State -->
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-2xl p-12 text-center">
        <div class="text-6xl mb-4">📚</div>
        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">开始你的学习之旅</h3>
        <p class="text-slate-600 dark:text-slate-400 mb-6">你还没有开始任何课程，现在就开始学习吧！</p>
        <a 
            href="{{ route('lessons.index') }}" 
            class="inline-flex items-center gap-2 px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-200 shadow-lg"
        >
            <span>开始学习</span>
            <span>→</span>
        </a>
    </div>
@endif
@endsection
