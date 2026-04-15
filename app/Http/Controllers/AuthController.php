<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * 显示注册表单
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    /**
     * 处理用户注册
     */
    public function register(Request $request): RedirectResponse
    {
        // 验证输入
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => '用户名不能为空',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '该邮箱已被注册',
            'password.required' => '密码不能为空',
            'password.min' => '密码至少需要6个字符',
            'password.confirmed' => '两次密码输入不一致',
        ]);

        // 创建用户
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', '注册成功，请登录');
    }

    /**
     * 显示登录表单
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * 处理用户登录
     */
    public function login(Request $request): RedirectResponse
    {
        // 验证输入
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'password.required' => '密码不能为空',
        ]);

        // 尝试认证
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', '登录成功');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', '邮箱或密码错误');
    }

    /**
     * 登出用户
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', '已安全登出');
    }
}
