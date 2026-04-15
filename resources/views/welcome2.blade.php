@extends('layout')

@section('title', '英语学习平台 - 专业的在线英语学习社区')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10 opacity-40">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/2 w-96 h-96 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative py-20 sm:py-32 text-center">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight">
            <span class="block text-slate-900 dark:text-white">学英语</span>
            <span class="block bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">一站式解决方案</span>
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-slate-600 dark:text-slate-400 max-w-3xl mx-auto leading-relaxed">
            📚 丰富课程 • 📊 进度追踪 • 🎯 个性化学习 • 🚀 随时随地学习
        </p>
        
        <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row gap-4 justify-center">
            @guest
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition duration-200 transform hover:scale-105">
                    立即注册 →
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-semibold rounded-lg transition duration-200">
                    登录
                </a>
            @else
                <a href="{{ route('lessons.index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition duration-200 transform hover:scale-105">
                    开始学习 →
                </a>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-3 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-semibold rounded-lg transition duration-200">
                    学习仪表板
                </a>
            @endguest
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-20 sm:py-24">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
        <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">为什么选择我们？</h2>
        <p class="mt-4 text-lg text-slate-600 dark:text-slate-400">完整的英语学习解决方案，助力你的英语梦想</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 p-8 hover:shadow-xl transition duration-300">
            <div class="text-4xl mb-4">📚</div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">丰富课程</h3>
            <p class="text-slate-600 dark:text-slate-400">
                涵盖基础词汇、语法、短语动词等多个主题，系统化学习英语。
            </p>
        </div>

        <!-- Feature 2 -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 p-8 hover:shadow-xl transition duration-300">
            <div class="text-4xl mb-4">📊</div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">进度追踪</h3>
            <p class="text-slate-600 dark:text-slate-400">
                清晰的学习进度统计，随时了解你的学习情况和成长空间。
            </p>
        </div>

        <!-- Feature 3 -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 p-8 hover:shadow-xl transition duration-300">
            <div class="text-4xl mb-4">🎯</div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">个性学习</h3>
            <p class="text-slate-600 dark:text-slate-400">
                根据难度等级选择，从初级到高级，满足不同学习需求。
            </p>
        </div>

        <!-- Feature 4 -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 p-8 hover:shadow-xl transition duration-300">
            <div class="text-4xl mb-4">🚀</div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">随时随地</h3>
            <p class="text-slate-600 dark:text-slate-400">
                在线学习平台，随时随地打开设备就能学英语。
            </p>
        </div>

        <!-- Feature 5 -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-50 to-rose-50 dark:from-pink-900/20 dark:to-rose-900/20 p-8 hover:shadow-xl transition duration-300">
            <div class="text-4xl mb-4">💪</div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">坚持学习</h3>
            <p class="text-slate-600 dark:text-slate-400">
                记录每次学习，激励自己坚持不懈，养成良好学习习惯。
            </p>
        </div>

        <!-- Feature 6 -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-violet-50 to-indigo-50 dark:from-violet-900/20 dark:to-indigo-900/20 p-8 hover:shadow-xl transition duration-300">
            <div class="text-4xl mb-4">🌟</div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">免费学习</h3>
            <p class="text-slate-600 dark:text-slate-400">
                完全免费的学习平台，让每个人都能接受优质的英语教育。
            </p>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="relative rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 dark:from-indigo-700 dark:via-purple-700 dark:to-indigo-700 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 1200 400" preserveAspectRatio="none">
            <path d="M0,200 Q300,100 600,200 T1200,200" stroke="white" stroke-width="2" fill="none" opacity="0.1"/>
        </svg>
    </div>
    
    <div class="relative py-16 px-6 sm:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
            准备好开始你的英语之旅了吗？
        </h2>
        <p class="text-lg text-indigo-100 mb-8 max-w-2xl mx-auto">
            加入我们的学习社区，提升英语水平，实现你的梦想。
        </p>
        @guest
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white hover:bg-slate-100 text-indigo-600 font-semibold rounded-lg transition duration-200 transform hover:scale-105 shadow-lg">
                免费注册 →
            </a>
        @else
            <a href="{{ route('lessons.index') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white hover:bg-slate-100 text-indigo-600 font-semibold rounded-lg transition duration-200 transform hover:scale-105 shadow-lg">
                查看课程 →
            </a>
        @endguest
    </div>
</div>

<style>
    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endsection

