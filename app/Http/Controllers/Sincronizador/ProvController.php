<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateProvRequest;
use App\Http\Requests\Sincronizador\UpdateProvRequest;
use App\Repositories\Sincronizador\ProvRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProvController extends AppBaseController
{
    /** @var  ProvRepository */
    private $provRepository;

    public function __construct(ProvRepository $provRepo)
    {
        $this->provRepository = $provRepo;
    }

    /**
     * Display a listing of the Prov.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $provs = $this->provRepository->paginate(15);

        return view('sincronizador.provs.index')
            ->with('provs', $provs);
    }

    /**
     * Show the form for creating a new Prov.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.provs.create');
    }

    /**
     * Store a newly created Prov in storage.
     *
     * @param CreateProvRequest $request
     *
     * @return Response
     */
    public function store(CreateProvRequest $request)
    {
        $input = $request->all();

        $prov = $this->provRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/provs.singular')]));

        return redirect(route('sincronizador.provs.index'));
    }

    /**
     * Display the specified Prov.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $prov = $this->provRepository->find($id);

        if (empty($prov)) {
            Flash::error(__('messages.not_found', ['model' => __('models/provs.singular')]));

            return redirect(route('sincronizador.provs.index'));
        }

        return view('sincronizador.provs.show')->with('prov', $prov);
    }

    /**
     * Show the form for editing the specified Prov.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $prov = $this->provRepository->find($id);

        if (empty($prov)) {
            Flash::error(__('messages.not_found', ['model' => __('models/provs.singular')]));

            return redirect(route('sincronizador.provs.index'));
        }

        return view('sincronizador.provs.edit')->with('prov', $prov);
    }

    /**
     * Update the specified Prov in storage.
     *
     * @param int $id
     * @param UpdateProvRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProvRequest $request)
    {
        $prov = $this->provRepository->find($id);

        if (empty($prov)) {
            Flash::error(__('messages.not_found', ['model' => __('models/provs.singular')]));

            return redirect(route('sincronizador.provs.index'));
        }

        $prov = $this->provRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/provs.singular')]));

        return redirect(route('sincronizador.provs.index'));
    }

    /**
     * Remove the specified Prov from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $prov = $this->provRepository->find($id);

        if (empty($prov)) {
            Flash::error(__('messages.not_found', ['model' => __('models/provs.singular')]));

            return redirect(route('sincronizador.provs.index'));
        }

        $this->provRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/provs.singular')]));

        return redirect(route('sincronizador.provs.index'));
    }
}
