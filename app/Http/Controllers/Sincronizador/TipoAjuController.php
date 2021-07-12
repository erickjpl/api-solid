<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateTipoAjuRequest;
use App\Http\Requests\Sincronizador\UpdateTipoAjuRequest;
use App\Repositories\Sincronizador\TipoAjuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TipoAjuController extends AppBaseController
{
    /** @var  TipoAjuRepository */
    private $tipoAjuRepository;

    public function __construct(TipoAjuRepository $tipoAjuRepo)
    {
        $this->tipoAjuRepository = $tipoAjuRepo;
    }

    /**
     * Display a listing of the TipoAju.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tipoAjus = $this->tipoAjuRepository->paginate(15);

        return view('sincronizador.tipo_ajus.index')
            ->with('tipoAjus', $tipoAjus);
    }

    /**
     * Show the form for creating a new TipoAju.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.tipo_ajus.create');
    }

    /**
     * Store a newly created TipoAju in storage.
     *
     * @param CreateTipoAjuRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoAjuRequest $request)
    {
        $input = $request->all();

        $tipoAju = $this->tipoAjuRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tipoAjus.singular')]));

        return redirect(route('sincronizador.tipoAjus.index'));
    }

    /**
     * Display the specified TipoAju.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoAju = $this->tipoAjuRepository->find($id);

        if (empty($tipoAju)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoAjus.singular')]));

            return redirect(route('sincronizador.tipoAjus.index'));
        }

        return view('sincronizador.tipo_ajus.show')->with('tipoAju', $tipoAju);
    }

    /**
     * Show the form for editing the specified TipoAju.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoAju = $this->tipoAjuRepository->find($id);

        if (empty($tipoAju)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoAjus.singular')]));

            return redirect(route('sincronizador.tipoAjus.index'));
        }

        return view('sincronizador.tipo_ajus.edit')->with('tipoAju', $tipoAju);
    }

    /**
     * Update the specified TipoAju in storage.
     *
     * @param int $id
     * @param UpdateTipoAjuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoAjuRequest $request)
    {
        $tipoAju = $this->tipoAjuRepository->find($id);

        if (empty($tipoAju)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoAjus.singular')]));

            return redirect(route('sincronizador.tipoAjus.index'));
        }

        $tipoAju = $this->tipoAjuRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/tipoAjus.singular')]));

        return redirect(route('sincronizador.tipoAjus.index'));
    }

    /**
     * Remove the specified TipoAju from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoAju = $this->tipoAjuRepository->find($id);

        if (empty($tipoAju)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoAjus.singular')]));

            return redirect(route('sincronizador.tipoAjus.index'));
        }

        $this->tipoAjuRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tipoAjus.singular')]));

        return redirect(route('sincronizador.tipoAjus.index'));
    }
}
