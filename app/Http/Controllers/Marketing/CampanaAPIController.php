<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Requests\Marketing\CreateCampanaAPIRequest;
use App\Http\Requests\Marketing\UpdateCampanaAPIRequest;
use App\Models\Marketing\Campana;
use App\Repositories\Marketing\CampanaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Marketing\CampanaResource;
use Response;

/**
 * Class CampanaController
 * @package App\Http\Controllers\Marketing
 */

use Erl\Application\Services\Marketing\CampanaCommand;
use Erl\Infrastructure\Bus\Contracts\CommandBus;

class CampanaAPIController extends AppBaseController
{
    /** @var  CampanaRepository */
    private $campanaRepository;

    public function __construct(CampanaRepository $campanaRepo)
    {
        $this->campanaRepository = $campanaRepo;
    }

    /**
     * Display a listing of the Campana.
     * GET|HEAD /campanas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $campanas = $this->campanaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            CampanaResource::collection($campanas),
            __('messages.retrieved', ['model' => __('models/campanas.plural')])
        );
    }

    /**
     * Store a newly created Campana in storage.
     * POST /campanas
     *
     * @param CreateCampanaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCampanaAPIRequest $request)
    {
        $input = $request->all();

        $campana = $this->campanaRepository->create($input);

        return $this->sendResponse(
            new CampanaResource($campana),
            __('messages.saved', ['model' => __('models/campanas.singular')])
        );
    }

    /**
     * Display the specified Campana.
     * GET|HEAD /campanas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Campana $campana */
        $campana = $this->campanaRepository->find($id);

        if (empty($campana)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/campanas.singular')])
            );
        }

        return $this->sendResponse(
            new CampanaResource($campana),
            __('messages.retrieved', ['model' => __('models/campanas.singular')])
        );
    }

    /**
     * Update the specified Campana in storage.
     * PUT/PATCH /campanas/{id}
     *
     * @param int $id
     * @param UpdateCampanaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCampanaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Campana $campana */
        $campana = $this->campanaRepository->find($id);

        if (empty($campana)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/campanas.singular')])
            );
        }

        $campana = $this->campanaRepository->update($input, $id);

        return $this->sendResponse(
            new CampanaResource($campana),
            __('messages.updated', ['model' => __('models/campanas.singular')])
        );
    }

    /**
     * Remove the specified Campana from storage.
     * DELETE /campanas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Campana $campana */
        $campana = $this->campanaRepository->find($id);

        if (empty($campana)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/campanas.singular')])
            );
        }

        $campana->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/campanas.singular')])
        );
    }
}
