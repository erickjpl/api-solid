<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateTipoCliRequest;
use App\Http\Requests\Sincronizador\UpdateTipoCliRequest;
use App\Repositories\Sincronizador\TipoCliRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TipoCliController extends AppBaseController
{
    /** @var  TipoCliRepository */
    private $tipoCliRepository;

    public function __construct(TipoCliRepository $tipoCliRepo)
    {
        $this->tipoCliRepository = $tipoCliRepo;
    }

    /**
     * Display a listing of the TipoCli.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tipoClis = $this->tipoCliRepository->paginate(15);

        return view('sincronizador.tipo_clis.index')
            ->with('tipoClis', $tipoClis);
    }

    /**
     * Show the form for creating a new TipoCli.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.tipo_clis.create');
    }

    /**
     * Store a newly created TipoCli in storage.
     *
     * @param CreateTipoCliRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoCliRequest $request)
    {
        $input = $request->all();

        $tipoCli = $this->tipoCliRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/tipoClis.singular')]));

        return redirect(route('sincronizador.tipoClis.index'));
    }

    /**
     * Display the specified TipoCli.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoCli = $this->tipoCliRepository->find($id);

        if (empty($tipoCli)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoClis.singular')]));

            return redirect(route('sincronizador.tipoClis.index'));
        }

        return view('sincronizador.tipo_clis.show')->with('tipoCli', $tipoCli);
    }

    /**
     * Show the form for editing the specified TipoCli.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoCli = $this->tipoCliRepository->find($id);

        if (empty($tipoCli)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoClis.singular')]));

            return redirect(route('sincronizador.tipoClis.index'));
        }

        return view('sincronizador.tipo_clis.edit')->with('tipoCli', $tipoCli);
    }

    /**
     * Update the specified TipoCli in storage.
     *
     * @param int $id
     * @param UpdateTipoCliRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoCliRequest $request)
    {
        $tipoCli = $this->tipoCliRepository->find($id);

        if (empty($tipoCli)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoClis.singular')]));

            return redirect(route('sincronizador.tipoClis.index'));
        }

        $tipoCli = $this->tipoCliRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/tipoClis.singular')]));

        return redirect(route('sincronizador.tipoClis.index'));
    }

    /**
     * Remove the specified TipoCli from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoCli = $this->tipoCliRepository->find($id);

        if (empty($tipoCli)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tipoClis.singular')]));

            return redirect(route('sincronizador.tipoClis.index'));
        }

        $this->tipoCliRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tipoClis.singular')]));

        return redirect(route('sincronizador.tipoClis.index'));
    }
}
