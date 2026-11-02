<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    public const CATEGORIES = [
        'khalaifa-generation' => 'Khalaifa Generation',
        'rekan-kerja' => 'Rekan kerja',
        'teman-seperjuangan' => 'Teman seperjuangan',
        'bapak-ibu' => 'Bapak/Ibu',
        'saudara' => 'Saudara/i',
        'lainnya' => 'Lainnya',
    ];

    protected $fillable = [
        'name',
        'category',
    ];

    public function wishes(): HasMany
    {
        return $this->hasMany(Wish::class);
    }
}
