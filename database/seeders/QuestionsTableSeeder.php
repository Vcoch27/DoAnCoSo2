<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        // Tạo dữ liệu cho bảng questions
        DB::table('questions')->insert([
            [
                'question_package_id' => 1, // ID của question package
                'question_text' => 'The UNION command is used to combine result sets from more than one query into a single result set',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_package_id' => 1,
                'question_text' => 'Which of the following scripts will run successfully',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_package_id' => 1,
                'question_text' => 'The ASC and DESC keywords can be used in the same statement',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_package_id' => 1,
                'question_text' => 'What will be the effect of the query SELECT c.*,e.* FROM clients c INNER JOIN employees e ON c.emp_no = e.emp_no;',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Tạo dữ liệu cho bảng answers
        DB::table('answers')->insert([
            [
                'question_id' => 1,
                'answer_text' => 'True',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 1,
                'answer_text' => 'False',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'answer_text' => 'Users statistics SELECT customer name FROM customers;',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'answer_text' => 'SELECT `customer name` FROM customers WHERE cat_id = 12 ORDER BY cat_id;',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'answer_text' => 'SELECT FROM `customers` \'customer name\';',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'answer_text' => 'SELECT `customer name` FROM customers ORDER BY zone WHERE cat_id = 12;',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 3,
                'answer_text' => 'True',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 3,
                'answer_text' => 'False',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 4,
                'answer_text' => 'return all the records from the clients table and only those that match the emp_no from the employees table',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 4,
                'answer_text' => 'The query will generate an error',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 4,
                'answer_text' => 'return all the records from the employees table and only those that match the emp_no from the clients table',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 4,
                'answer_text' => 'return only records that have matching emp_no values in both tables',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
