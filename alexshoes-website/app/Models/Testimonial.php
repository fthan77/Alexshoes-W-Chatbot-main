<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'comment', 'rating'];


    protected $casts = [
        'name' => 'string',
        'comment' => 'string',
        'rating' => 'integer',
        'is_approved' => 'boolean',
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset($this->photo)
            : asset('images/default-user.jpg');
    }
}
