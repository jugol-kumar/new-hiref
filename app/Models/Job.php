<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @method static create(array $data)
 * @method static where(string $string, int|string|null $id)
 */
class Job extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = ['id'];

    protected $dates = ['declined_date'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    public function company(){
        return $this->belongsTo(Company::class, 'company');
    }

    public function companyDetails(){
        return $this->belongsTo(Company::class, 'company');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'creator');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'currency');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_category(){
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function child_category(){
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }


}
