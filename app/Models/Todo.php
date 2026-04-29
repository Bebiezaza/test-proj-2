<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Table('todos')]
class Todo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'checked' => 'boolean',
        ];
    }
}
