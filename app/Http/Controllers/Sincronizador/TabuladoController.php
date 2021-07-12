<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateTabuladoRequest;
use App\Http\Requests\Sincronizador\UpdateTabuladoRequest;
use App\Repositories\Sincronizador\TabuladoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TabuladoController extends AppBaseController
{
    /** @var  TabuladoRepository */
    private $tabuladoRepository;

    public function __construct(TabuladoRepository $tabuladoRepo)
    {
        $this->tabuladoRepository = $tabuladoRepo;
    }

    /**
     * Display a listing of the Tabulado.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tabulados = $this->tabuladoRepository->paginate(15);

        return view('sincronizador.tabulados.index')
            ->with('tabulados', $tabulados);
    }

    /**
     * Show the form for creating a new Tabulado.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.tabulados.create');
    }

    /**
     * Store a newly created Tabulado in storage.
     *
     * @param CreateTabuladoRequest $request
     *
     * @return Response
     */
    public function store(CreateTabuladoRequest $request)
    {
        $input = $request->all();

        $tabulado = $this->tabuladoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tabulados.singular')]));

        return redirect(route('sincronizador.tabulados.index'));
    }

    /**
     * Display the specified Tabulado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tabulado = $this->tabuladoRepository->find($id);

        if (empty($tabulado)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tabulados.singular')]));

            return redirect(route('sincronizador.tabulados.index'));
        }

        return view('sincronizador.tabulados.show')->with('tabulado', $tabulado);
    }

    /**
     * Show the form for editing the specified Tabulado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tabulado = $this->tabuladoRepository->find($id);

        if (empty($tabulado)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tabulados.singular')]));

            return redirect(route('sincronizador.tabulados.index'));
        }

        return view('sincronizador.tabulados.edit')->with('tabulado', $tabulado);
    }

    /**
     * Update the specified Tabulado in storage.
     *
     * @param int $id
     * @param UpdateTabuladoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTabuladoRequest $request)
    {
        $tabulado = $this->tabuladoRepository->find($id);

        if (empty($tabulado)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tabulados.singular')]));

            return redirect(route('sincronizador.tabulados.index'));
        }

        $tabulado = $this->tabuladoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/tabulados.singular')]));

        return redirect(route('sincronizador.tabulados.index'));
    }

    /**
     * Remove the specified Tabulado from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tabulado = $this->tabuladoRepository->find($id);

        if (empty($tabulado)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tabulados.singular')]));

            return redirect(route('sincronizador.tabulados.index'));
        }

        $this->tabuladoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tabulados.singular')]));

        return redirect(route('sincronizador.tabulados.index'));
    }
}
