<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LearningProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LessonController extends Controller
{
    /**
     * 显示所有课程
     */
    public function index(Request $request): View
    {
        $query = Lesson::query();

        // 按难度筛选
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // 按分类筛选
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $lessons = $query->paginate(12);

        return view('lessons.index', [
            'lessons' => $lessons,
            'levels' => ['beginner' => '初级', 'intermediate' => '中级', 'advanced' => '高级'],
            'categories' => ['vocabulary' => '词汇', 'grammar' => '语法', 'phrasal_verbs' => '短语动词'],
        ]);
    }

    /**
     * 显示课程详情
     */
    public function show(Lesson $lesson): View
    {
        $progress = null;
        if (Auth::check()) {
            $progress = LearningProgress::where('user_id', Auth::id())
                ->where('lesson_id', $lesson->id)
                ->first();
        }

        return view('lessons.show', [
            'lesson' => $lesson,
            'progress' => $progress,
        ]);
    }

    /**
     * 获取用户的学习仪表板
     */
    public function dashboard(): View
    {
        $user = Auth::user();
        $progress = $user->learningProgress()->with('lesson')->get();
        
        $stats = [
            'total_lessons' => $progress->count(),
            'completed_lessons' => $progress->where('completed', true)->count(),
            'total_study_time' => $progress->sum('times_studied'),
        ];

        return view('lessons.dashboard', [
            'user' => $user,
            'progress' => $progress,
            'stats' => $stats,
        ]);
    }

    /**
     * 更新学习进度
     */
    public function updateProgress(Request $request, Lesson $lesson)
    {
        $request->validate([
            'progress_percentage' => 'required|integer|min:0|max:100',
            'completed' => 'boolean',
        ]);

        $progress = LearningProgress::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'lesson_id' => $lesson->id,
            ]
        );

        $progress->update([
            'progress_percentage' => $request->progress_percentage,
            'completed' => $request->boolean('completed', $progress->progress_percentage >= 100),
            'times_studied' => $progress->times_studied + 1,
            'last_studied_at' => now(),
        ]);

        return redirect()->back()->with('success', '学习进度已更新');
    }
}
