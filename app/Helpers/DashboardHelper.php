<?php

namespace App\Helpers;

class DashboardHelper
{
    public static function getCategoryTagColor(string $category): string
    {
        switch ($category) {
            case 'Mengenali Emosi':
                return 'bg-blue-100 text-blue-800';
            case 'Jurnal Emosi':
                return 'bg-green-100 text-green-800';
            case 'Musik dan Emosi':
                return 'bg-purple-100 text-purple-800';
            case 'Mood Tracker & Self-care':
                return 'bg-yellow-100 text-yellow-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    public static function getEmotionTagColor(string $emotion): string
    {
        // Ubah input emosi menjadi huruf kecil agar case-insensitive
        $emotionLower = strtolower($emotion);

        // Sesuaikan dengan daftar emosi yang mungkin ada di lagu Anda (sekarang dalam huruf kecil)
        switch ($emotionLower) {
            case 'senang':
                return 'bg-yellow-100 text-yellow-800';
            case 'sedih':
                return 'bg-blue-100 text-blue-800';
            case 'marah':
                return 'bg-red-100 text-red-800';
            case 'cemas':
                return 'bg-teal-100 text-teal-800';
            default:
                return 'bg-gray-100 text-gray-800'; // Default jika tidak cocok
        }
    }
}