<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkCurtoStoreRequest;
use App\Models\Link;
use App\Models\LinkCurto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LinkCurtoController extends Controller
{
    protected $linksCurtos;

    public function __construct(LinkCurto $linksCurtos)
    {
        $this->linksCurtos = $linksCurtos;
    }

    public function index(Request $request)
    {
        try {
            $linksCurtos = $this->linksCurtos->linksCurtos($request['link_id']);
            return response()->json(['success' => true, 'linksCurtos' => $linksCurtos]);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function store(LinkCurtoStoreRequest $request)
    {
        try {
            $validacao = $this->linksCurtos->salvar($request);

            return response()->json(['success' => $validacao]);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $this->linksCurtos->apagar($request);
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function redirecionamento($codigo)
    {
        try {
            $linkCurto = $this->linksCurtos->validacaoLinkCurto((array)$codigo);

            if (!$linkCurto) {
                return response()->json(['success' => false, 'message' => 'Link inválido']);
            }
            return response()->json(['success' => true, 'link' => $linkCurto->link]);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(['success' => false, 'message' => $exception->getMessage()]);
        }
    }
}
