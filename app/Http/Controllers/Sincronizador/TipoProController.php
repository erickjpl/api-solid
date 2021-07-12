<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateTipoProRequest;
use App\Http\Requests\Sincronizador\UpdateTipoProRequest;
use App\Repositories\Sincronizador\TipoProRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TipoProController extends AppBaseController
{
    /** @var  TipoProRepository */
    private $tipoProRepository;

    public function __construct(TipoProRepository $tipoProRepo)
    {
        $this->tipoProRepository = $tipoProRepo;
    }

    /**
     * Display a listing of the TipoPro.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tipoPros = $this->tipoProRepository->paginate(15);

        return view('sincronizador.tipo_pros.index')
            ->with('tipoPros', $tipoPros);
    }

    /**
     * Show the form for creating a new TipoPro.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.tipo_pros.create');
    }

    /**
     * Store a newly created TipoPro in storage.
     *
     * @param CreateTipoProRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoProRequest $request)
    {
        $input = $request->all();

        $tipoPro = $this->tipoProRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tipoPros.singular')]));

        return redirect(route('sincronizador.tipoPros.index'));
    }

    /**
     * Display the specified TipoPro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoPro = $this->tipoProRepository->find($id);

        if (empty($tipoPro)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoPros.singular')]));

            return redirect(route('sincronizador.tipoPros.index'));
        }

        return view('sincronizador.tipo_pros.show')->with('tipoPro', $tipoPro);
    }

    /**
     * Show the form for editing the specified TipoPro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoPro = $this->tipoProRepository->find($id);

        if (empty($tipoPro)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoPros.singular')]));

            return redirect(route('sincronizador.tipoPros.index'));
        }

        return view('sincronizador.tipo_pros.edit')->with('tipoPro', $tipoPro);
    }

    /**
     * Update the specified TipoPro in storage.
     *
     * @param int $id
     * @param UpdateTipoProRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoProRequest $request)
    {
        $tipoPro = $this->tipoProRepository->find($id);

        if (empty($tipoPro)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoPros.singular')]));

            return redirect(route('sincronizador.tipoPros.index'));
        }

        $tipoPro = $this->tipoProRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/tipoPros.singular')]));

        return redirect(route('sincronizador.tipoPros.index'));
    }

    /**
     * Remove the specified TipoPro from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoPro = $this->tipoProRepository->find($id);

        if (empty($tipoPro)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoPros.singular')]));

            return redirect(route('sincronizador.tipoPros.index'));
        }

        $this->tipoProRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tipoPros.singular')]));

        return redirect(route('sincronizador.tipoPros.index'));
    }
}
