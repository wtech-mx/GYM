<?php

namespace App\Http\Controllers\Backend;

// use App\Http\Requests\health\StorehealthRequest;
// use App\Http\Requests\health\UpdatehealthRequest;

use App\Models\Health;
use App\Models\Customers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class HealthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Gate::authorize('app.health.index');
        $health = Health::get();
        $customers = Customers::get();
        return view('backend.health.index', compact('health', 'customers'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.health.create');
        $customers = Customers::get();

        return view('backend.health.form', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHealthRequest $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $health = Health::create([
            'calorie' => $request->calorie,
            'height' => $request->height,
            'weight' => $request->weight,
            'fat' => $request->fat,
            'remarks' => $request->remarks,
            'id_user' => $request->id_user,
        ]);

        notify()->success('Estado de salud agregado con éxito.', 'Added');
        return redirect()->route('app.health.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Health  $health
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $health)
    {
        $health = Health::findOrFail($health);

        return view('backend.health.show', compact('health'));
    }


    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\Health  $health
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Gate::authorize('app.health.edit');

        $health = Health::findOrFail($id);
        $customers = Customers::get();

        return view('backend.health.form', compact('health', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHealthRequest $request
     * @param health $health
     * @return \Illuminate\Http\Response
     *
     */
    public function update(Request $request, $id)
    {

        $health = Health::findOrFail($id);
        $health->update([
            'calorie' => $request->calorie,
            'height' => $request->height,
            'weight' => $request->weight,
            'fat' => $request->fat,
            'remarks' => $request->remarks,
            'id_user' => $request->id_user,
        ]);

        notify()->success('Estado de salud actualizado con éxito.', 'Updated');
        return redirect()->route('app.health.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Health $health
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function destroy(Request $request, $id)
    {
        Gate::authorize('app.health.destroy');

        $idEntero = intval($id);

        $health = Health::findOrFail($id);

        if ($health->deletable == true) {
            $health->delete();

            notify()->success("Estado de salud correctamente eliminado", "Deleted");
        } else {
            notify()->error('Sorry you can\'t delete Estado de salud.', 'Error');
        }
        return redirect()->back();
    }
}
