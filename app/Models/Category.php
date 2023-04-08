<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    // implement this method to customize the log name
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_category')
            ->using(ProductCategory::class)
            ->withTimestamps();
    }
}
