<?php

namespace App\Http\Controllers\Sincronizador;

use App\Http\Requests\Sincronizador\CreateCtaIngrRequest;
use App\Http\Requests\Sincronizador\UpdateCtaIngrRequest;
use App\Repositories\Sincronizador\CtaIngrRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CtaIngrController extends AppBaseController
{
    /** @var  CtaIngrRepository */
    private $ctaIngrRepository;

    public function __construct(CtaIngrRepository $ctaIngrRepo)
    {
        $this->ctaIngrRepository = $ctaIngrRepo;
    }

    /**
     * Display a listing of the CtaIngr.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ctaIngrs = $this->ctaIngrRepository->paginate(15);

        return view('sincronizador.cta_ingrs.index')
            ->with('ctaIngrs', $ctaIngrs);
    }

    /**
     * Show the form for creating a new CtaIngr.
     *
     * @return Response
     */
    public function create()
    {
        return view('sincronizador.cta_ingrs.create');
    }

    /**
     * Store a newly created CtaIngr in storage.
     *
     * @param CreateCtaIngrRequest $request
     *
     * @return Response
     */
    public function store(CreateCtaIngrRequest $request)
    {
        $input = $request->all();

        $ctaIngr = $this->ctaIngrRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/ctaIngrs.singular')]));

        return redirect(route('sincronizador.ctaIngrs.index'));
    }

    /**
     * Display the specified CtaIngr.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ctaIngr = $this->ctaIngrRepository->find($id);

        if (empty($ctaIngr)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ctaIngrs.singular')]));

            return redirect(route('sincronizador.ctaIngrs.index'));
        }

        return view('sincronizador.cta_ingrs.show')->with('ctaIngr', $ctaIngr);
    }

    /**
     * Show the form for editing the specified CtaIngr.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ctaIngr = $this->ctaIngrRepository->find($id);

        if (empty($ctaIngr)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ctaIngrs.singular')]));

            return redirect(route('sincronizador.ctaIngrs.index'));
        }

        return view('sincronizador.cta_ingrs.edit')->with('ctaIngr', $ctaIngr);
    }

    /**
     * Update the specified CtaIngr in storage.
     *
     * @param int $id
     * @param UpdateCtaIngrRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCtaIngrRequest $request)
    {
        $ctaIngr = $this->ctaIngrRepository->find($id);

        if (empty($ctaIngr)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ctaIngrs.singular')]));

            return redirect(route('sincronizador.ctaIngrs.index'));
        }

        $ctaIngr = $this->ctaIngrRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/ctaIngrs.singular')]));

        return redirect(route('sincronizador.ctaIngrs.index'));
    }

    /**
     * Remove the specified CtaIngr from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ctaIngr = $this->ctaIngrRepository->find($id);

        if (empty($ctaIngr)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ctaIngrs.singular')]));

            return redirect(route('sincronizador.ctaIngrs.index'));
        }

        $this->ctaIngrRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/ctaIngrs.singular')]));

        return redirect(route('sincronizador.ctaIngrs.index'));
    }
}
