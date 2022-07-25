<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'link'
    ];

    protected $table = 'links';

    public function linksCurtos()
    {
        return $this->hasMany(LinkCurto::class);
    }

    public function links()
    {
        return Link::latest()
            ->paginate(15);
    }

    public function salvar($request)
    {
        $validated = $request->validated();

        $validated['created_at'] = now();
        Link::insert($validated);
    }

    public function apagar(Link $link)
    {
        $link->delete();
    }
}
