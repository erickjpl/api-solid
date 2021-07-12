<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateZonaRequest;
use App\Http\Requests\Sincronizador\UpdateZonaRequest;
use App\Repositories\Sincronizador\ZonaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ZonaController extends AppBaseController
{
    /** @var  ZonaRepository */
    private $zonaRepository;

    public function __construct(ZonaRepository $zonaRepo)
    {
        $this->zonaRepository = $zonaRepo;
    }

    /**
     * Display a listing of the Zona.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $zonas = $this->zonaRepository->paginate(15);

        return view('sincronizador.zonas.index')
            ->with('zonas', $zonas);
    }

    /**
     * Show the form for creating a new Zona.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.zonas.create');
    }

    /**
     * Store a newly created Zona in storage.
     *
     * @param CreateZonaRequest $request
     *
     * @return Response
     */
    public function store(CreateZonaRequest $request)
    {
        $input = $request->all();

        $zona = $this->zonaRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/zonas.singular')]));

        return redirect(route('sincronizador.zonas.index'));
    }

    /**
     * Display the specified Zona.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $zona = $this->zonaRepository->find($id);

        if (empty($zona)) {
            Flash::error(__('messages.not_found', ['model' => __('models/zonas.singular')]));

            return redirect(route('sincronizador.zonas.index'));
        }

        return view('sincronizador.zonas.show')->with('zona', $zona);
    }

    /**
     * Show the form for editing the specified Zona.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $zona = $this->zonaRepository->find($id);

        if (empty($zona)) {
            Flash::error(__('messages.not_found', ['model' => __('models/zonas.singular')]));

            return redirect(route('sincronizador.zonas.index'));
        }

        return view('sincronizador.zonas.edit')->with('zona', $zona);
    }

    /**
     * Update the specified Zona in storage.
     *
     * @param int $id
     * @param UpdateZonaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateZonaRequest $request)
    {
        $zona = $this->zonaRepository->find($id);

        if (empty($zona)) {
            Flash::error(__('messages.not_found', ['model' => __('models/zonas.singular')]));

            return redirect(route('sincronizador.zonas.index'));
        }

        $zona = $this->zonaRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/zonas.singular')]));

        return redirect(route('sincronizador.zonas.index'));
    }

    /**
     * Remove the specified Zona from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $zona = $this->zonaRepository->find($id);

        if (empty($zona)) {
            Flash::error(__('messages.not_found', ['model' => __('models/zonas.singular')]));

            return redirect(route('sincronizador.zonas.index'));
        }

        $this->zonaRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/zonas.singular')]));

        return redirect(route('sincronizador.zonas.index'));
    }
}
