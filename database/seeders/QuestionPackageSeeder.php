<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionPackage;

class QuestionPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Lập trình căn bản',
                'author_id' => 1, // Đảm bảo author_id này tồn tại trong bảng users
                'question_count' => 10,
                'images' => 'hinh1.jpg',
                'description' => 'Khóa học lập trình căn bản dành cho người mới bắt đầu.',
                'rating' => 4.2,
                'attempt_count' => 150,
            ],
            [
                'title' => 'Lập trình hướng đối tượng',
                'author_id' => 1,
                'question_count' => 15,
                'images' => 'hinh2.jpg',
                'description' => 'Khóa học về lập trình hướng đối tượng trong các ngôn ngữ phổ biến.',
                'rating' => 4.5,
                'attempt_count' => 120,
            ],
            [
                'title' => 'Lập trình web cơ bản',
                'author_id' => 1,
                'question_count' => 20,
                'images' => 'hinh3.jpg',
                'description' => 'Giới thiệu về lập trình web và các kỹ thuật cơ bản.',
                'rating' => 4.3,
                'attempt_count' => 200,
            ],
            [
                'title' => 'Lập trình Python nâng cao',
                'author_id' => 1,
                'question_count' => 25,
                'images' => 'hinh4.jpg',
                'description' => 'Khóa học nâng cao về lập trình Python.',
                'rating' => 4.8,
                'attempt_count' => 180,
            ],
            [
                'title' => 'Lập trình cho trí tuệ nhân tạo',
                'author_id' => 1,
                'question_count' => 30,
                'images' => 'hinh5.jpg',
                'description' => 'Học cách lập trình các thuật toán trí tuệ nhân tạo.',
                'rating' => 4.7,
                'attempt_count' => 250,
            ],
        ];

        foreach ($data as $item) {
            QuestionPackage::create($item);
        }
    }
}
