<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class PackageTagSeeder extends Seeder
{
    public function run()
    {
        // Các ID của gói câu hỏi
        $packageIds = [1, 3, 5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];

        // Lấy tất cả các tag
        $tags = Tag::all();

        foreach ($packageIds as $packageId) {
            // Ngẫu nhiên chọn số lượng tag cho mỗi gói câu hỏi (0, 1, 2 hoặc 3 tag)
            $numTags = rand(0, 3);

            if ($numTags > 0) {
                // Chọn ngẫu nhiên các tag từ danh sách tag
                $randomTags = $tags->random($numTags);

                foreach ($randomTags as $tag) {
                    DB::table('package_tag')->insert([
                        'package_id' => $packageId,
                        'tag_id' => $tag->id,
                    ]);
                }
            }
        }
    }
}
