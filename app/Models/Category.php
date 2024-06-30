<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'is_active'
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'category_id'); // Assuming 'category_id' is the foreign key
    }
}
