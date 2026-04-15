@extends('layout')

@section('title', $lesson->title . ' - 英语学习平台')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-700 dark:to-purple-700 rounded-2xl text-white p-8 mb-8 shadow-lg">
    <div class="flex items-start justify-between mb-4">
        <div class="flex-1">
            <h1 class="text-4xl font-bold mb-2">{{ $lesson->title }}</h1>
            <p class="text-indigo-100 max-w-2xl">{{ $lesson->description ?? '开始学习这个课程' }}</p>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4 pt-4 border-t border-indigo-400">
        <div class="flex items-center gap-2">
            <span class="text-lg">📂</span>
            <span>{{ $categories[$lesson->category] ?? $lesson->category }}</span>
        </div>
        <div class="flex items-center gap-2 px-3 py-1 bg-white/20 rounded-full">
            <span>🎯</span>
            <span>
                @if($lesson->level === 'beginner') 初级
                @elseif($lesson->level === 'intermediate') 中级
                @else 高级
                @endif
            </span>
        </div>
        @if($lesson->duration)
            <div class="flex items-center gap-2">
                <span class="text-lg">⏱️</span>
                <span>{{ $lesson->duration }}分钟</span>
            </div>
        @endif
    </div>
</div>

<!-- Progress Section (if logged in) -->
@auth
    @if($progress)
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">📊 你的学习进度</h2>
            
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-slate-700 dark:text-slate-300">完成度</span>
                        <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">{{ $progress->progress_percentage }}%</span>
                    </div>
                    <div class="w-full h-3 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                        <div 
                            class="h-full bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-300"
                            style="width: {{ $progress->progress_percentage }}%"
                        ></div>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">学习次数</p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $progress->times_studied }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">最后学习</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">
                            {{ $progress->last_studied_at?->diffForHumans() ?? '未开始' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth

<!-- Course Content -->
<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md p-8 mb-8">
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">📖 课程内容</h2>
    <div class="prose dark:prose-invert prose-sm max-w-none prose-pre:rounded-xl prose-pre:bg-slate-900 prose-pre:text-slate-100">
        <div class="text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-wrap font-mono text-sm">
            {!! nl2br(e($lesson->content)) !!}
        </div>
    </div>
</div>

<!-- Action Buttons -->
@auth
    <div class="flex flex-col sm:flex-row gap-4 mb-8">
        <form method="POST" action="{{ route('lessons.updateProgress', $lesson) }}" class="flex-1">
            @csrf
            <input type="hidden" name="progress_percentage" value="{{ min(($progress->progress_percentage ?? 0) + 25, 100) }}">
            <input type="hidden" name="completed" value="{{ (($progress->progress_percentage ?? 0) + 25) >= 100 ? 'true' : 'false' }}">
            <button 
                type="submit" 
                class="w-full px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2"
            >
                <span>✓</span>
                <span>标记进度完成</span>
            </button>
        </form>

        <a 
            href="{{ route('lessons.index') }}" 
            class="px-6 py-3 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-semibold rounded-lg transition duration-200 flex items-center justify-center gap-2"
        >
            <span>←</span>
            <span>返回课程列表</span>
        </a>
    </div>
@else
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-2xl p-6 text-center mb-8">
        <p class="text-blue-900 dark:text-blue-200 mb-4 font-medium">要跟踪你的学习进度，请先登录</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a 
                href="{{ route('login') }}" 
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200"
            >
                登录
            </a>
            <a 
                href="{{ route('register') }}" 
                class="px-6 py-2 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-semibold rounded-lg transition duration-200"
            >
                注册
            </a>
        </div>
    </div>

    <div class="text-center">
        <a 
            href="{{ route('lessons.index') }}" 
            class="inline-flex items-center gap-2 px-6 py-3 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-semibold rounded-lg transition duration-200"
        >
            <span>←</span>
            <span>返回课程列表</span>
        </a>
    </div>
@endauth
@endsection
