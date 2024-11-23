<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryBlog extends BaseModel
{
    /**
     * Get the category_parent that owns the CategoryBlog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category_parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
