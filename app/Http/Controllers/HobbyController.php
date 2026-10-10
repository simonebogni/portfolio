<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Hobby;
use Inertia\Response;

class HobbyController extends Controller
{
    public function index(): Response
    {
        return self::render('Hobbies', [
            'hobbies' => Hobby::query()->orderBy('id')->get()->map(fn (Hobby $hobby): array => [
                'id' => $hobby->id,
                'title' => $hobby->title,
                'description' => $hobby->description,
                'coverImgUrl' => $hobby->cover_img_url,
            ]),
        ]);
    }
}
