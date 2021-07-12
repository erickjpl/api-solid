<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateSegmentoRequest;
use App\Http\Requests\Sincronizador\UpdateSegmentoRequest;
use App\Repositories\Sincronizador\SegmentoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SegmentoController extends AppBaseController
{
    /** @var  SegmentoRepository */
    private $segmentoRepository;

    public function __construct(SegmentoRepository $segmentoRepo)
    {
        $this->segmentoRepository = $segmentoRepo;
    }

    /**
     * Display a listing of the Segmento.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $segmentos = $this->segmentoRepository->paginate(15);

        return view('sincronizador.segmentos.index')
            ->with('segmentos', $segmentos);
    }

    /**
     * Show the form for creating a new Segmento.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.segmentos.create');
    }

    /**
     * Store a newly created Segmento in storage.
     *
     * @param CreateSegmentoRequest $request
     *
     * @return Response
     */
    public function store(CreateSegmentoRequest $request)
    {
        $input = $request->all();

        $segmento = $this->segmentoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/segmentos.singular')]));

        return redirect(route('sincronizador.segmentos.index'));
    }

    /**
     * Display the specified Segmento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $segmento = $this->segmentoRepository->find($id);

        if (empty($segmento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/segmentos.singular')]));

            return redirect(route('sincronizador.segmentos.index'));
        }

        return view('sincronizador.segmentos.show')->with('segmento', $segmento);
    }

    /**
     * Show the form for editing the specified Segmento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $segmento = $this->segmentoRepository->find($id);

        if (empty($segmento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/segmentos.singular')]));

            return redirect(route('sincronizador.segmentos.index'));
        }

        return view('sincronizador.segmentos.edit')->with('segmento', $segmento);
    }

    /**
     * Update the specified Segmento in storage.
     *
     * @param int $id
     * @param UpdateSegmentoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSegmentoRequest $request)
    {
        $segmento = $this->segmentoRepository->find($id);

        if (empty($segmento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/segmentos.singular')]));

            return redirect(route('sincronizador.segmentos.index'));
        }

        $segmento = $this->segmentoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/segmentos.singular')]));

        return redirect(route('sincronizador.segmentos.index'));
    }

    /**
     * Remove the specified Segmento from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $segmento = $this->segmentoRepository->find($id);

        if (empty($segmento)) {
            Flash::error(__('messages.not_found', ['model' => __('models/segmentos.singular')]));

            return redirect(route('sincronizador.segmentos.index'));
        }

        $this->segmentoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/segmentos.singular')]));

        return redirect(route('sincronizador.segmentos.index'));
    }
}
