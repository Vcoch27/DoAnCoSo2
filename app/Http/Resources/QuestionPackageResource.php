<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionPackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author_id' => $this->author_id,
            'question_count' => $this->question_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'images' => $this->images,
            'description' => $this->description,
            // 'rating' => $this->rating,
            'attempt_count' => $this->attempt_count,
            'public' => $this->public,
            'tags' => $this->tags->pluck('name'), // Lấy danh sách tên các tag
        ];
    }
}
