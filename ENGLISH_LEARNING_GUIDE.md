# 📚 英语学习平台 - English Learning Platform

这是一个使用 Laravel 11 构建的在线英语学习平台，包含用户认证、课程管理和学习进度追踪功能。

## 功能特性 ✨

### 用户认证
- ✅ 用户注册（新用户创建账户）
- ✅ 用户登录（邮箱和密码认证）
- ✅ 用户登出（安全退出）
- ✅ 会话管理（记住我功能）

### 课程管理
- ✅ 课程浏览（查看所有英语课程）
- ✅ 课程分类（按难度和分类筛选）
- ✅ 课程详情（查看完整课程内容）
- ✅ 课程难度（初级/中级/高级）
- ✅ 课程分类（词汇/语法/短语动词）

### 学习进度
- ✅ 进度追踪（记录学习进度百分比）
- ✅ 学习统计（统计学习次数和时间）
- ✅ 学习仪表板（个性化学习界面）
- ✅ 进度可视化（进度条显示）

## 数据库表结构 🗄️

### users 表
```
id              - 用户ID (主键)
name            - 用户名
email           - 邮箱地址 (唯一)
password        - 加密密码
email_verified_at - 邮箱验证时间
remember_token  - 记住我令牌
timestamps      - 创建和更新时间戳
```

### lessons 表
```
id              - 课程ID (主键)
title           - 课程标题
description     - 课程描述
content         - 课程内容
level           - 难度级别 (beginner/intermediate/advanced)
category        - 分类 (vocabulary/grammar/phrasal_verbs)
duration        - 学习时长 (分钟)
timestamps      - 创建和更新时间戳
```

### learning_progress 表
```
id              - 记录ID (主键)
user_id         - 用户ID (外键)
lesson_id       - 课程ID (外键)
progress_percentage - 完成进度 (0-100%)
completed       - 是否完成 (boolean)
times_studied   - 学习次数
last_studied_at - 最后学习时间
timestamps      - 创建和更新时间戳
unique          - (user_id, lesson_id) 的组合唯一
```

## 项目设置 🚀

### 1. 克隆项目
```bash
cd c:\Fujitsu\TEMP\dev\laravel
```

### 2. 安装依赖
```bash
composer install
npm install
```

### 3. 环境配置
```bash
# 复制环境文件
cp .env.example .env

# 生成应用密钥
php artisan key:generate
```

### 4. 数据库配置
编辑 `.env` 文件配置数据库：
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=english_learning
DB_USERNAME=root
DB_PASSWORD=
```

### 5. 运行迁移
```bash
# 创建数据库表
php artisan migrate

# 导入示例数据
php artisan db:seed
```

### 6. 启动服务器
```bash
# 启动 Laravel 服务器
php artisan serve

# 在另外一个终端启动 Vite (用于资产编译)
npm run dev
```

### 7. 访问应用
打开浏览器访问：`http://localhost:8000`

## 路由说明 🗺️

### 公开路由
- `GET  /`                          - 首页
- `GET  /register`                  - 注册页面
- `POST /register`                  - 处理注册
- `GET  /login`                     - 登录页面
- `POST /login`                     - 处理登录
- `GET  /lessons`                   - 课程列表
- `GET  /lessons/{id}`              - 课程详情

### 受保护路由（需要登录）
- `POST /logout`                    - 登出
- `GET  /dashboard`                 - 学习仪表板
- `POST /lessons/{id}/progress`     - 更新学习进度

## 项目结构 📂

```
laravel/
├── app/
│   ├── Models/
│   │   ├── User.php              - 用户模型
│   │   ├── Lesson.php            - 课程模型
│   │   └── LearningProgress.php   - 学习进度模型
│   └── Http/
│       └── Controllers/
│           ├── AuthController.php      - 认证控制器
│           └── LessonController.php    - 课程控制器
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_04_15_000001_create_lessons_table.php
│   │   └── 2026_04_15_000002_create_learning_progress_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── LessonSeeder.php
├── resources/
│   └── views/
│       ├── layout.blade.php       - 主布局
│       ├── welcome.blade.php      - 首页
│       ├── auth/
│       │   ├── register.blade.php - 注册页面
│       │   └── login.blade.php    - 登录页面
│       └── lessons/
│           ├── index.blade.php    - 课程列表
│           ├── show.blade.php     - 课程详情
│           └── dashboard.blade.php - 学习仪表板
└── routes/
    └── web.php                    - 网络路由定义
```

## 示例账户 👤

运行迁移和数据填充后，会创建一个测试账户：
- 邮箱：`test@example.com`
- 密码：`password`

## 开发指南 🛠️

### 添加新课程
1. 编辑 `database/seeders/LessonSeeder.php`
2. 在 `$lessons` 数组中添加新课程数据
3. 运行：`php artisan migrate:fresh --seed`

### 自定义样式
编辑 `resources/views/layout.blade.php` 中的 `<style>` 标签

### 添加新功能
1. 创建迁移：`php artisan make:migration add_new_column_to_table`
2. 创建模型方法
3. 创建控制器方法
4. 添加路由
5. 创建视图

## 常见问题 ❓

### Q: 如何重置数据库？
```bash
php artisan migrate:fresh --seed
```

### Q: 如何创建新管理员？
编辑 `DatabaseSeeder.php` 并添加用户创建代码

### Q: 如何修改课程内容？
在数据库中直接更新 `lessons` 表，或通过编辑 Seeder 重新导入

## 技术栈 🛠️

- **后端框架**：Laravel 11
- **数据库**：MySQL
- **前端**：Blade 模板引擎 + HTML/CSS
- **身份认证**：Laravel Authentication
- **数据验证**：Laravel Validation

## 许可证 📄

MIT License

## 作者 👨‍💻

英语学习平台开发团队

---

## 快速命令参考 📋

```bash
# PHP Artisan 命令
php artisan serve                      # 启动开发服务器
php artisan migrate                    # 运行迁移
php artisan migrate:fresh              # 重置并运行迁移
php artisan db:seed                    # 运行数据填充
php artisan migrate:fresh --seed       # 重置并执行迁移和填充
php artisan tinker                     # 打开交互式 shell

# NPM 命令
npm run dev                            # 启动 Vite 开发服务器
npm run build                          # 构建生产资源
```

祝你学习英语愉快！🎉
