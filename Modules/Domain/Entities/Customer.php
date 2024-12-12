<?php

namespace Modules\Domain\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($customer) {
            $customer->user?->delete();
        });
    }
}
