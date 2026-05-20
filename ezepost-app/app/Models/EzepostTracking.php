<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class EzepostTracking extends Model
{
    use HasFactory;
    protected $table = 'ezepost_tracking';

    protected $fillable = [
        'sender_ezepost_user_id',
        'receiver_ezepost_user_id',
        'transfer_reference',
        'direction',
        'file_count',
        'file_name',
        'file_names',
        'file_size',
        'package_size',
        'status',
        'is_viewed',
        'transferred_at',
        'viewed_at',
        'sender_name',
        'sender_vepost_addr',
        'receiver_name',
        'receiver_vepost_addr',
        'sender_user_id',
        'receiver_user_id',
        'file_path',
        'message',
        'controlstring',
        'notify_recipient',
        'require_password',
        'track_download',
        'expires_at',
        'received_at',
        'opened_at',
    ];

    protected $casts = [
        'file_names' => 'array',
        'transferred_at' => 'datetime',
        'viewed_at' => 'datetime',
        'is_viewed' => 'boolean',
    ];

    protected $appends = ['file_size_formatted'];

    public function senderUser()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }

    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }

    public function senderEzepostUser()
    {
        return $this->belongsTo(EzepostUser::class, 'sender_ezepost_user_id');
    }

    public function receiverEzepostUser()
    {
        return $this->belongsTo(EzepostUser::class, 'receiver_ezepost_user_id');
    }

    // Legacy relationships
    public function sender()
    {
        return $this->senderUser();
    }

    public function receiver()
    {
        return $this->receiverUser();
    }

    protected function fileSizeFormatted(): Attribute
    {
        return Attribute::make(
            get: function () {
                $bytes = $this->file_size ?? 0;
                
                if ($bytes >= 1073741824) {
                    return number_format($bytes / 1073741824, 2) . ' GB';
                } elseif ($bytes >= 1048576) {
                    return number_format($bytes / 1048576, 2) . ' MB';
                } elseif ($bytes >= 1024) {
                    return number_format($bytes / 1024, 2) . ' KB';
                } else {
                    return $bytes . ' B';
                }
            }
        );
    }
}
