<?php

namespace App\Models;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
    ];

    /**
     * Get the user that owns the post.
     *
     * @return BelongsTo<User, Post>
     */
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
