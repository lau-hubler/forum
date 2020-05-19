<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Thread extends Model
{
    protected $guarded = [];

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply): void
    {
        $this->replies()->create($reply);
    }
}
