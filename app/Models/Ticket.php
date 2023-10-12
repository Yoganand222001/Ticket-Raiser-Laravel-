<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Ticket extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_ticket');
    }
    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'label_ticket');
    }
    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Ticket Logs')
            ->logFillable()
            ->logOnlyDirty()
            ->setDescriptionForEvent(function(string $eventName){
                if($eventName == 'updated') return "The ticket with id ". $this->id .'has been '. $eventName .' by '. (isset($this->agent_id) ? '# '.$this->agent_id : '# '.auth()->id());
                if($eventName == 'deleted') return "The ticket with id ". $this->id .'has been '. $eventName .' by '.'# '.auth()->id();
                return "The ticket with id ". $this->id .'has been '. $eventName .' by '. '# '. $this->user_id;
            });
    }
}
