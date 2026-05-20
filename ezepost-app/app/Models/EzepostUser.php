<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EzepostUser extends Model
{
    use HasFactory;
    protected $table = 'ezepost_user';

    protected $fillable = [
        'user_id',
        'user_group',
        'username',
        'vepost_addr',
        'password',
        'displayname',
        'controlstring',
        'balance',
        'vepost_counter',
        'status',
        'free_send_left',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sentTransfers()
    {
        return $this->hasMany(EzepostTracking::class, 'sender_ezepost_user_id');
    }

    public function receivedTransfers()
    {
        return $this->hasMany(EzepostTracking::class, 'receiver_ezepost_user_id');
    }
}
