<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EzepostTracking extends Model
{
    use HasFactory;
    protected $table = 'ezepost_tracking';

    protected $fillable = [
        'sender_ezepost_user_id','receiver_ezepost_user_id','transfer_reference',
        'direction','file_count','file_names','package_size','status',
        'transferred_at','viewed_at',
    ];

    protected $casts = [
        'file_names' => 'array',
        'transferred_at' => 'datetime',
        'viewed_at' => 'datetime',
    ];

    public function sender() { return $this->belongsTo(EzepostUser::class, 'sender_ezepost_user_id'); }
    public function receiver() { return $this->belongsTo(EzepostUser::class, 'receiver_ezepost_user_id'); }
}
