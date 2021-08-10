<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $table = 'movements';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'type',
        'user_id',
        'value',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
