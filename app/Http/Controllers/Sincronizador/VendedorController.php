<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateVendedorRequest;
use App\Http\Requests\Sincronizador\UpdateVendedorRequest;
use App\Repositories\Sincronizador\VendedorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class VendedorController extends AppBaseController
{
    /** @var  VendedorRepository */
    private $vendedorRepository;

    public function __construct(VendedorRepository $vendedorRepo)
    {
        $this->vendedorRepository = $vendedorRepo;
    }

    /**
     * Display a listing of the Vendedor.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $vendedors = $this->vendedorRepository->paginate(15);

        return view('sincronizador.vendedors.index')
            ->with('vendedors', $vendedors);
    }

    /**
     * Show the form for creating a new Vendedor.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.vendedors.create');
    }

    /**
     * Store a newly created Vendedor in storage.
     *
     * @param CreateVendedorRequest $request
     *
     * @return Response
     */
    public function store(CreateVendedorRequest $request)
    {
        $input = $request->all();

        $vendedor = $this->vendedorRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/vendedors.singular')]));

        return redirect(route('sincronizador.vendedors.index'));
    }

    /**
     * Display the specified Vendedor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vendedor = $this->vendedorRepository->find($id);

        if (empty($vendedor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vendedors.singular')]));

            return redirect(route('sincronizador.vendedors.index'));
        }

        return view('sincronizador.vendedors.show')->with('vendedor', $vendedor);
    }

    /**
     * Show the form for editing the specified Vendedor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vendedor = $this->vendedorRepository->find($id);

        if (empty($vendedor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vendedors.singular')]));

            return redirect(route('sincronizador.vendedors.index'));
        }

        return view('sincronizador.vendedors.edit')->with('vendedor', $vendedor);
    }

    /**
     * Update the specified Vendedor in storage.
     *
     * @param int $id
     * @param UpdateVendedorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVendedorRequest $request)
    {
        $vendedor = $this->vendedorRepository->find($id);

        if (empty($vendedor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vendedors.singular')]));

            return redirect(route('sincronizador.vendedors.index'));
        }

        $vendedor = $this->vendedorRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/vendedors.singular')]));

        return redirect(route('sincronizador.vendedors.index'));
    }

    /**
     * Remove the specified Vendedor from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vendedor = $this->vendedorRepository->find($id);

        if (empty($vendedor)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vendedors.singular')]));

            return redirect(route('sincronizador.vendedors.index'));
        }

        $this->vendedorRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/vendedors.singular')]));

        return redirect(route('sincronizador.vendedors.index'));
    }
}
