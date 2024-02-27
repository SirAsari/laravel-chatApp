<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function isMember($userId)
    {
        $authorizedUsers = json_decode($this->authorized_users, true);
        return in_array($userId, $authorizedUsers);
    }
}
