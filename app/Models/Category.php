<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $date = ['deleted_at'];
    protected $table = 'categories';
    protected $fillable = [
            'parent_id',
            'section_id',
            'category_name',
            'category_icon',
            'category_discount',
            'description',
            'url',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'status',
    ];

    // Relation belongto entre category et section
    public function section():BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // Relation belongto entre category et section
    public function categoryParent():BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

}
