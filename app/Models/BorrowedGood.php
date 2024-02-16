<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedGood extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function Good()
    {
        return $this->belongsTo(Good::class);
    }
    
    public function Recipient()
    {
        return $this->belongsTo(Recipient::class, 'receipent_id');
    }
}
