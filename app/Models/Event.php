<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'organizer_id',
        'category_id',
        'title',
        'description',
        'date',
        'location',
        'price',
        'stock',
        'poster_path'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // ...
    // ... ($fillable kalian dari pertemuan lalu biarkan tidak diubah) 

    // Menandakan atribut: 1 Event harus terpaut pada satu wujud Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(
            Review::class,
            Transaction::class,
            'event_id',
            'transaction_id',
            'id',
            'id'
        );
    }
}
