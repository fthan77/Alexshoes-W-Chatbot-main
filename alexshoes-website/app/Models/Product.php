<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['name', 'description', 'price', 'image', 'detail_benefits', 'detail_process'];

    protected $casts = [
        'price' => 'float',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image 
            ? asset($this->image) 
            : asset('images/no-image.png');
    }
}
