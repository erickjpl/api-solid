<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateProcedenRequest;
use App\Http\Requests\Sincronizador\UpdateProcedenRequest;
use App\Repositories\Sincronizador\ProcedenRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProcedenController extends AppBaseController
{
    /** @var  ProcedenRepository */
    private $procedenRepository;

    public function __construct(ProcedenRepository $procedenRepo)
    {
        $this->procedenRepository = $procedenRepo;
    }

    /**
     * Display a listing of the Proceden.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $procedens = $this->procedenRepository->paginate(15);

        return view('sincronizador.procedens.index')
            ->with('procedens', $procedens);
    }

    /**
     * Show the form for creating a new Proceden.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.procedens.create');
    }

    /**
     * Store a newly created Proceden in storage.
     *
     * @param CreateProcedenRequest $request
     *
     * @return Response
     */
    public function store(CreateProcedenRequest $request)
    {
        $input = $request->all();

        $proceden = $this->procedenRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/procedens.singular')]));

        return redirect(route('sincronizador.procedens.index'));
    }

    /**
     * Display the specified Proceden.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $proceden = $this->procedenRepository->find($id);

        if (empty($proceden)) {
            Flash::error(__('messages.not_found', ['model' => __('models/procedens.singular')]));

            return redirect(route('sincronizador.procedens.index'));
        }

        return view('sincronizador.procedens.show')->with('proceden', $proceden);
    }

    /**
     * Show the form for editing the specified Proceden.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $proceden = $this->procedenRepository->find($id);

        if (empty($proceden)) {
            Flash::error(__('messages.not_found', ['model' => __('models/procedens.singular')]));

            return redirect(route('sincronizador.procedens.index'));
        }

        return view('sincronizador.procedens.edit')->with('proceden', $proceden);
    }

    /**
     * Update the specified Proceden in storage.
     *
     * @param int $id
     * @param UpdateProcedenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProcedenRequest $request)
    {
        $proceden = $this->procedenRepository->find($id);

        if (empty($proceden)) {
            Flash::error(__('messages.not_found', ['model' => __('models/procedens.singular')]));

            return redirect(route('sincronizador.procedens.index'));
        }

        $proceden = $this->procedenRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/procedens.singular')]));

        return redirect(route('sincronizador.procedens.index'));
    }

    /**
     * Remove the specified Proceden from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $proceden = $this->procedenRepository->find($id);

        if (empty($proceden)) {
            Flash::error(__('messages.not_found', ['model' => __('models/procedens.singular')]));

            return redirect(route('sincronizador.procedens.index'));
        }

        $this->procedenRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/procedens.singular')]));

        return redirect(route('sincronizador.procedens.index'));
    }
}
