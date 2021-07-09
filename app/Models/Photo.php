<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['file'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getFileAttribute($value)
    {
        if ($value) {
            return url('images/photos/'.$value);
        }
        return null;
    }
    
}
