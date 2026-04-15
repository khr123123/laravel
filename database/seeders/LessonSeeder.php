<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * 运行数据库 Seeder
     */
    public function run(): void
    {
        $lessons = [
            [
                'title' => '英文字母和发音',
                'description' => '学习26个英文字母和基础发音规则',
                'content' => '字母 A: /eɪ/ 发音如"cake"中的"a"
字母 B: /biː/ 发音如"bee"
字母 C: /siː/ 发音如"see"
...以此类推学习所有26个字母的正确发音和书写方式。',
                'level' => 'beginner',
                'category' => 'vocabulary',
                'duration' => 15,
            ],
            [
                'title' => '日常100个必学单词',
                'description' => '掌握日常英语交流中最常用的100个单词',
                'content' => 'Hello (你好) - /həˈloʊ/
Goodbye (再见) - /ɡʊdˈbaɪ/
Thank you (谢谢) - /θæŋk juː/
Please (请) - /pliːz/
Yes (是) - /jɛs/
No (否) - /noʊ/
Water (水) - /ˈwɔːtər/
Food (食物) - /fuːd/
...以及其他92个常用单词',
                'level' => 'beginner',
                'category' => 'vocabulary',
                'duration' => 30,
            ],
            [
                'title' => '英文基础语法：句子结构',
                'description' => '理解英文简单句、复合句等基础语法',
                'content' => '英文句子基本结构：主语 + 谓语 + 宾语
例：I love English.
     (我) (喜欢) (英语)

问句结构：Does + 主语 + 动词...?
例：Do you like coffee?

否定句：主语 + do not + 动词
例：I do not like coffee.

现在进行时：am/is/are + -ing
例：I am studying English.',
                'level' => 'beginner',
                'category' => 'grammar',
                'duration' => 40,
            ],
            [
                'title' => '现在完成时态详解',
                'description' => '掌握现在完成时的用法和时间表达',
                'content' => '现在完成时基本结构：have/has + 过去分词

用法1：表示过去发生但对现在有影响的动作
例：I have finished my homework.

用法2：表示从过去持续到现在的动作
例：She has worked here for 5 years.

时间标志词：for, since, never, ever, already, yet, just

常见动词过去分词：
go → gone
eat → eaten
see → seen
write → written',
                'level' => 'intermediate',
                'category' => 'grammar',
                'duration' => 45,
            ],
            [
                'title' => '常用短语动词 (Phrasal Verbs)',
                'description' => '学习实用的英文短语动词',
                'content' => 'Put on (穿上): Put on your coat, it\'s cold.

Take off (脱掉): Take off your shoes.

Look up (查阅): Look up the word in the dictionary.

Give up (放弃): Don\'t give up on your dreams.

Get up (起床): I get up at 7 AM every day.

Sit down (坐下): Sit down and relax.

Wake up (醒来): She wakes up early.

Turn on (打开): Turn on the TV.

Turn off (关闭): Turn off the light.',
                'level' => 'intermediate',
                'category' => 'phrasal_verbs',
                'duration' => 30,
            ],
            [
                'title' => '商务英语常用表达',
                'description' => '学习在商务场景中常用的英文表达',
                'content' => '会议开场：
Good morning everyone. Let\'s begin the meeting.

提出议题：
Let\'s discuss the quarterly report.

表达同意：
I agree with you. / That\'s a good point.

表达不同意：
I don\'t think so. / I have a different opinion.

请求澄清：
Could you clarify that point?

总结：
In conclusion, we have three main goals.

结束会议：
Let\'s wrap up. We\'ll continue next week.',
                'level' => 'advanced',
                'category' => 'vocabulary',
                'duration' => 50,
            ],
            [
                'title' => '虚拟语气 (Conditional Sentences)',
                'description' => '掌握英文虚拟语气和条件句的用法',
                'content' => '第一条件句（真实条件）：
If + 现在时，will + 动词原形
If you study hard, you will pass the exam.

第二条件句（假设）：
If + 过去时，would + 动词原形
If I were you, I would study more.

第三条件句（过去假设）：
If + had + 过去分词，would have + 过去分词
If I had studied, I would have passed.

混合条件句：
If + 过去，would + 现在
If I had studied, I would speak English better now.',
                'level' => 'advanced',
                'category' => 'grammar',
                'duration' => 60,
            ],
            [
                'title' => '英文写作技巧',
                'description' => '学习如何写出优秀的英文文章',
                'content' => '段落结构：
- 主题句（Topic Sentence）
- 支持句（Supporting Sentences）
- 结尾句（Concluding Sentence）

文章结构：
- 引言（Introduction）：引起读者注意，提出论点
- 正文（Body）：用2-3个段落支持你的论点
- conclusion（结论）：总结观点

写作技巧：
1. 使用过渡词（However, Furthermore, In addition）
2. 避免重复
3. 使用多样的句式
4. 检查语法和拼写',
                'level' => 'advanced',
                'category' => 'vocabulary',
                'duration' => 55,
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
}
