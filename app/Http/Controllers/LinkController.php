<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkStoreRequest;
use App\Models\Link;
use Illuminate\Validation\ValidationException;

class LinkController extends Controller
{
    protected $links;

    public function __construct(Link $links)
    {
        $this->links = $links;
    }

    public function index()
    {
        try {
            $links = $this->links->links();

            return response()->json(['success' => true, 'links' => $links]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    public function store(LinkStoreRequest $request)
    {
        try {
            $this->links->salvar($request);

            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    public function destroy(Link $link)
    {
        try {
            $this->links->apagar($link);

            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }
}
