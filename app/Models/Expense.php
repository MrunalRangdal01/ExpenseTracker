<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id', // The foreign key column in the expenses table
        'amount',
        'description',
        'date'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

}
