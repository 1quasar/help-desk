<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'departament_id',
        'title',
        'requester_name',
        'priority',
        'description',
        'status'
    ];

    public function departament(): BelongsTo
    {
        return $this->belongsTo(Departament::class);
    }
}
