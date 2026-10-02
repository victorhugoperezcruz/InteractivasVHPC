<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = $request->user()->recipes()->latest();

        if ($request->filled('buscar')) {
            $query->where('titulo', 'like', '%' . $request->input('buscar') . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->input('categoria'));
        }

        $recipes = $query->paginate(10)->withQueryString();

        $categorias = ['desayuno', 'almuerzo', 'cena', 'postre', 'bebida'];

        return view('recipes.index', compact('recipes', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categorias = ['desayuno', 'almuerzo', 'cena', 'postre', 'bebida'];
        $dificultades = ['fácil', 'media', 'difícil'];

        return view('recipes.create', compact('categorias', 'dificultades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request): RedirectResponse
    {
        $request->user()->recipes()->create($request->validated());

        return redirect()->route('recipes.index')
            ->with('exito', 'Receta creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Recipe $recipe): View|RedirectResponse
    {
        if ($recipe->user_id !== $request->user()->id) {
            abort(403, 'No tienes permiso para ver esta receta.');
        }

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Recipe $recipe): View
    {
        if ($recipe->user_id !== $request->user()->id) {
            abort(403, 'No tienes permiso para editar esta receta.');
        }

        $categorias = ['desayuno', 'almuerzo', 'cena', 'postre', 'bebida'];
        $dificultades = ['fácil', 'media', 'difícil'];

        return view('recipes.edit', compact('recipe', 'categorias', 'dificultades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe): RedirectResponse
    {
        if ($recipe->user_id !== $request->user()->id) {
            abort(403, 'No tienes permiso para actualizar esta receta.');
        }

        $recipe->update($request->validated());

        return redirect()->route('recipes.index')
            ->with('exito', 'Receta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Recipe $recipe): RedirectResponse
    {
        if ($recipe->user_id !== $request->user()->id) {
            abort(403, 'No tienes permiso para eliminar esta receta.');
        }

        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('exito', 'Receta eliminada correctamente.');
    }
}
