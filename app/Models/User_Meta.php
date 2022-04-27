<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class User_Meta extends Model
{
    use HasFactory;

    protected $table='user_metas';

    public function user(){
            return $this->belongsTo(User::class);

    }
}
