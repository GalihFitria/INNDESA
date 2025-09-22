<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    protected $fillable = ['page_name', 'views'];

    /**
     * Increment view count for a page
     *
     * @param string $pageName
     * @return int
     */
    public static function incrementView(string $pageName): int
    {
        $pageView = self::firstOrCreate(
            ['page_name' => $pageName],
            ['views' => 0]
        );

        $pageView->increment('views');

        return $pageView->views;
    }

    /**
     * Get view count for a page
     *
     * @param string $pageName
     * @return int
     */
    public static function getViewCount(string $pageName): int
    {
        $pageView = self::where('page_name', $pageName)->first();

        return $pageView ? $pageView->views : 0;
    }
}
