<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTicket extends Model
{
    use HasFactory;

    protected $table = 'category_ticket';

    protected $fillable = ['ticket_id', 'category_id'];
}
