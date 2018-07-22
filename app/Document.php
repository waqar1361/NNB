<?php

namespace App;

class Document extends Model {

    protected $dates = ['issued_at'];
    public function getRouteKeyName()
    {
        return "file";
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function scopeNotices( $query )
    {
        return $query->where('tags', 'like', "%notice%");
    }

    public function scopeNotifications( $query )
    {
        return $query->where('tags', 'like', "%notification%");
    }

    public static function archives()
    {
        return static::selectRaw("year(issued_at) year, monthname(issued_at) month, count(*) published")
            ->groupBy('month','year')
            ->orderByRaw('min(issued_at) desc')
            ->get();
    }

}