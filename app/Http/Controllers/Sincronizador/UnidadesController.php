<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateUnidadesRequest;
use App\Http\Requests\Sincronizador\UpdateUnidadesRequest;
use App\Repositories\Sincronizador\UnidadesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class UnidadesController extends AppBaseController
{
    /** @var  UnidadesRepository */
    private $unidadesRepository;

    public function __construct(UnidadesRepository $unidadesRepo)
    {
        $this->unidadesRepository = $unidadesRepo;
    }

    /**
     * Display a listing of the Unidades.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $unidades = $this->unidadesRepository->paginate(15);

        return view('sincronizador.unidades.index')
            ->with('unidades', $unidades);
    }

    /**
     * Show the form for creating a new Unidades.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.unidades.create');
    }

    /**
     * Store a newly created Unidades in storage.
     *
     * @param CreateUnidadesRequest $request
     *
     * @return Response
     */
    public function store(CreateUnidadesRequest $request)
    {
        $input = $request->all();

        $unidades = $this->unidadesRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/unidades.singular')]));

        return redirect(route('sincronizador.unidades.index'));
    }

    /**
     * Display the specified Unidades.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $unidades = $this->unidadesRepository->find($id);

        if (empty($unidades)) {
            Flash::error(__('messages.not_found', ['model' => __('models/unidades.singular')]));

            return redirect(route('sincronizador.unidades.index'));
        }

        return view('sincronizador.unidades.show')->with('unidades', $unidades);
    }

    /**
     * Show the form for editing the specified Unidades.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unidades = $this->unidadesRepository->find($id);

        if (empty($unidades)) {
            Flash::error(__('messages.not_found', ['model' => __('models/unidades.singular')]));

            return redirect(route('sincronizador.unidades.index'));
        }

        return view('sincronizador.unidades.edit')->with('unidades', $unidades);
    }

    /**
     * Update the specified Unidades in storage.
     *
     * @param int $id
     * @param UpdateUnidadesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUnidadesRequest $request)
    {
        $unidades = $this->unidadesRepository->find($id);

        if (empty($unidades)) {
            Flash::error(__('messages.not_found', ['model' => __('models/unidades.singular')]));

            return redirect(route('sincronizador.unidades.index'));
        }

        $unidades = $this->unidadesRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/unidades.singular')]));

        return redirect(route('sincronizador.unidades.index'));
    }

    /**
     * Remove the specified Unidades from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $unidades = $this->unidadesRepository->find($id);

        if (empty($unidades)) {
            Flash::error(__('messages.not_found', ['model' => __('models/unidades.singular')]));

            return redirect(route('sincronizador.unidades.index'));
        }

        $this->unidadesRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/unidades.singular')]));

        return redirect(route('sincronizador.unidades.index'));
    }
}
