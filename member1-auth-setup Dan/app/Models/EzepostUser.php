<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EzepostUser extends Model
{
    use HasFactory;
    protected $table = 'ezepost_user';

    protected $fillable = [
        'user_id','desktop_username','desktop_password_hash','controllingstring',
        'topup_balance','stripe_customer_id','team_role','package_limit_code',
        'team_size_code','group_code','plan_code','desktop_account_status',
    ];

    protected $casts = ['topup_balance' => 'decimal:2'];

    public function user() { return $this->belongsTo(User::class); }
    public function sentTransfers() { return $this->hasMany(EzepostTracking::class, 'sender_ezepost_user_id'); }
    public function receivedTransfers() { return $this->hasMany(EzepostTracking::class, 'receiver_ezepost_user_id'); }
}
