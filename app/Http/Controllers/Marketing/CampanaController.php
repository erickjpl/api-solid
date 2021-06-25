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
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function store(CreateCampanaAPIRequest $request)
    {
        $command = new CreateCampanaCommand(
            $request->campana,
            $request->from_name,
            $request->from_email,
            $request->asunto,
            $request->fecha,
            $request->status,
            $request->lista,
            $request->total_audiencia,
            $request->step,
            $request->email
        );

        $this->commandBus->execute($command);

        return $this->sendResponse(
            new CampanaResource($campana),
            __('messages.saved', ['model' => __('models/campanas.singular')])
        );
    }
}
