<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use App\Models\Marketing\Campana;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Marketing\CampanaResource;
use Epl\Campana\Application\UseCase\FindCampanaUseCase;
use App\Http\Requests\Marketing\CreateCampanaAPIRequest;
use App\Http\Requests\Marketing\UpdateCampanaAPIRequest;
use Epl\Campana\Infrastructure\Eloquent\CampanaRepository;

/**
 * Class CampanaController
 * @package App\Http\Controllers\Marketing
 */

class CampanaController extends AppBaseController
{
    private $repository;

    public function __construct(CampanaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show(int $id)
    {
        $command = new FindCampanaUseCase($this->repository);

        try {
            $entity = $command->execute($id);

            if (empty($entity))
                return $this->sendError(__('messages.not_found', ['model' => __('models/campanas.singular')]));
        } catch (\Exception $exception) {
            Log::error("[CampanaAPIController][show][exception] {$exception}");
            return $this->sendError(__('messages.not_found', ['model' => __('models/campanas.singular')]));
        }

        return $this->sendResponse(
            new CampanaResource($entity), __('messages.retrieved', ['model' => __('models/campanas.singular')])
        );
    }

    public function store(CreateCampanaAPIRequest $request)
    {
        $command = new CreateCampanaUseCase($this->repository);

        try {
            $entity = $command->execute(CampanaHandler::fromRequest($request));
        } catch (\Exception $exception) {
            Log::error("[CampanaAPIController][store][exception] {$exception->getMessage()}");
        }

        return $this->sendResponse(
            new CampanaResource($entity),
            __('messages.saved', ['model' => __('models/campanas.singular')])
        );
    }
}
