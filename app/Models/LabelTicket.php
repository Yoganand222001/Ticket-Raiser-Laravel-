<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelTicket extends Model
{
    use HasFactory;

    protected $table = 'label_ticket';

    protected $fillable = ['ticket_id', 'label_id'];
}

