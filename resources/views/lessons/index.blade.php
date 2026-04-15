@extends('layout')

@section('title', '英语课程 - 英语学习平台')

@section('content')
<!-- Header -->
<div class="mb-12">
    <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-2">📚 英语课程库</h1>
    <p class="text-lg text-slate-600 dark:text-slate-400">选择适合你的课程，开始英语学习之旅</p>
</div>

<!-- Filter Section -->
<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md p-6 mb-8">
    <form method="GET" action="{{ route('lessons.index') }}" class="grid md:grid-cols-3 gap-4">
        <div>
            <label for="level" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                难度等级
            </label>
            <select 
                name="level" 
                id="level"
                class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                onchange="this.form.submit()"
            >
                <option value="">全部难度</option>
                @foreach($levels as $value => $label)
                    <option value="{{ $value }}" {{ request('level') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="category" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                课程分类
            </label>
            <select 
                name="category" 
                id="category"
                class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                onchange="this.form.submit()"
            >
                <option value="">全部分类</option>
                @foreach($categories as $value => $label)
                    <option value="{{ $value }}" {{ request('category') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end">
            <button 
                type="submit" 
                class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-200"
            >
                搜索
            </button>
        </div>
    </form>
</div>

<!-- Lessons Grid -->
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
    @forelse($lessons as $lesson)
        <a href="{{ route('lessons.show', $lesson) }}" class="group">
            <div class="h-full bg-white dark:bg-slate-800 rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden hover:scale-105 transform">
                <!-- Color indicator ribbon -->
                <div class="h-2 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                
                <div class="p-6">
                    <!-- Level Badge -->
                    <div class="flex items-center justify-between mb-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            @if($lesson->level === 'beginner') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                            @elseif($lesson->level === 'intermediate') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                            @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300
                            @endif
                        ">
                            @if($lesson->level === 'beginner') 初级
                            @elseif($lesson->level === 'intermediate') 中级
                            @else 高级
                            @endif
                        </span>
                        @if($lesson->duration)
                            <span class="text-xs text-slate-500 dark:text-slate-400">⏱️ {{ $lesson->duration }}分钟</span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                        {{ $lesson->title }}
                    </h3>

                    <!-- Description -->
                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-2">
                        {{ $lesson->description ?? '暂无描述' }}
                    </p>

                    <!-- Category -->
                    <div class="flex items-center text-sm text-slate-500 dark:text-slate-400 pt-4 border-t border-slate-200 dark:border-slate-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        {{ $categories[$lesson->category] ?? $lesson->category }}
                    </div>
                </div>
            </div>
        </a>
    @empty
        <div class="col-span-full">
            <div class="text-center py-12">
                <div class="text-6xl mb-4">📚</div>
                <p class="text-xl text-slate-600 dark:text-slate-400 mb-4">暂无课程</p>
                <p class="text-slate-500 dark:text-slate-500">请尝试调整筛选条件</p>
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($lessons->hasPages())
    <div class="flex justify-center items-center gap-2">
        {{ $lessons->links() }}
    </div>
@endif
@endsection
