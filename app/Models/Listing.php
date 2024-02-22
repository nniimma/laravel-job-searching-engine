<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'website',
        'email',
        'logo',
        'tags',
        'description'

    ];

    public function scopeFilter($query, array $filters)
    {
        // ! it means if there is a tag do this if not just go on:
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        //! in where we are saying that we want to search in the title in the database:
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // ! relationship to user
    // ! by default it is user_id, so we dont need to mention that by if the name of the foreign key is different than tableName_id, we need to mention that
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
