<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $date = ['deleted_at'];
    protected $table = 'sections';
    protected $fillable = ['name','description','status','section_icon'];


    public function section():HasMany
    {
        return $this->hasMany(Category::class, 'section_id');
    }


}
