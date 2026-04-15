<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '英语学习平台')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('extra-styles')
</head>
<body class="bg-slate-50 dark:bg-slate-900">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="text-2xl">📚</span>
                        <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            English Learn
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">
                        首页
                    </a>
                    <a href="{{ route('lessons.index') }}" class="text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">
                        课程
                    </a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">
                            仪表板
                        </a>
                    @endauth
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">
                                登出
                            </button>
                        </form>
                        <span class="hidden sm:inline text-slate-600 dark:text-slate-400">
                            {{ Auth::user()->name }}
                        </span>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">
                            登录
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition shadow-md hover:shadow-lg">
                            注册
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-[calc(100vh-200px)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Alerts -->
            @if ($message = Session::get('success'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-center gap-3">
                    <span class="text-green-600 dark:text-green-400 text-lg">✓</span>
                    <p class="text-green-800 dark:text-green-200">{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-center gap-3">
                    <span class="text-red-600 dark:text-red-400 text-lg">✕</span>
                    <p class="text-red-800 dark:text-red-200">{{ $message }}</p>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 dark:bg-black text-slate-300 mt-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-white font-bold mb-4">📚 English Learn</h3>
                    <p class="text-sm text-slate-400">专业的在线英语学习平台，帮助你轻松掌握英语。</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">快速链接</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-white transition">首页</a></li>
                        <li><a href="{{ route('lessons.index') }}" class="text-slate-400 hover:text-white transition">课程</a></li>
                        @auth<li><a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition">仪表板</a></li>@endauth
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">学习</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('lessons.index') }}?level=beginner" class="text-slate-400 hover:text-white transition">初级课程</a></li>
                        <li><a href="{{ route('lessons.index') }}?level=intermediate" class="text-slate-400 hover:text-white transition">中级课程</a></li>
                        <li><a href="{{ route('lessons.index') }}?level=advanced" class="text-slate-400 hover:text-white transition">高级课程</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-8">
                <p class="text-center text-slate-400 text-sm">
                    &copy; 2026 English Learn Platform. 保留所有权利。
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
