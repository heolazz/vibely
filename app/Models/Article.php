<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Article extends Model
    {
        use HasFactory;

        protected $fillable = [
            'title',
            'content',
            'excerpt',
            'category'
        ];

        // Opsional: Accessor untuk read_time jika Anda ingin
        public function getReadTimeAttribute()
        {
            $wordCount = str_word_count(strip_tags($this->content));
            $minutes = ceil($wordCount / 200); // Rata-rata 200 kata per menit
            return $minutes . ' min Read';
        }
    }