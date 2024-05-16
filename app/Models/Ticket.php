<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $with = ['user:id,name,image','comments.user:id,name,image'];

    protected $fillable = [
        'user_id',
        'content',
        'title',
        'urgent',
        'status',
        'rate'
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search ){
        $query->where('content','like','%' . $search . '%');
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}
    
}
