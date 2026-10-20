<?php

namespace App\Http\Controllers;

use App\Services\CartExpirationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    public function index(Request $request, CartExpirationService $cartExpiration)
    {
        $cartExpiration->releaseExpired();
        $search = $request->query('query', '');
        $query = is_string($search) ? mb_substr(trim($search), 0, 100) : '';
        $ejemplares = DB::table('view_all_ejemplares')
            ->where(function ($builder) use ($query) {
                $builder->where('titulo', 'like', "%{$query}%")
                    ->orWhere('autores', 'like', "%{$query}%");
            })
            ->get();

        return view('app.catalogo.index', compact('ejemplares', 'query'));
    }

    public function show(string $id, CartExpirationService $cartExpiration)
    {
        $cartExpiration->releaseExpired();
        $ejemplar = DB::table('view_all_ejemplares')->where('id', $id)->first();
        abort_unless($ejemplar, 404);

        return view('app.catalogo.show', compact('ejemplar'));
    }
}
