<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Requests\Configuracion\CreateConnectionRequest;
use App\Http\Requests\Configuracion\UpdateConnectionRequest;
use App\Repositories\Configuracion\ConnectionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ConnectionController extends AppBaseController
{
    /** @var  ConnectionRepository */
    private $connectionRepository;

    public function __construct(ConnectionRepository $connectionRepo)
    {
        $this->connectionRepository = $connectionRepo;
    }

    /**
     * Display a listing of the Connection.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $connections = $this->connectionRepository->paginate(15);

        return view('configuracion.connections.index')
            ->with('connections', $connections);
    }

    /**
     * Show the form for creating a new Connection.
     *
     * @return Response
     */
    public function create()
    {
        return view('configuracion.connections.create');
    }

    /**
     * Store a newly created Connection in storage.
     *
     * @param CreateConnectionRequest $request
     *
     * @return Response
     */
    public function store(CreateConnectionRequest $request)
    {
        $input = $request->all();

        $connection = $this->connectionRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/connections.singular')]));

        return redirect(route('configuracion.connections.index'));
    }

    /**
     * Display the specified Connection.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $connection = $this->connectionRepository->find($id);

        if (empty($connection)) {
            Flash::error(__('messages.not_found', ['model' => __('models/connections.singular')]));

            return redirect(route('configuracion.connections.index'));
        }

        return view('configuracion.connections.show')->with('connection', $connection);
    }

    /**
     * Show the form for editing the specified Connection.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $connection = $this->connectionRepository->find($id);

        if (empty($connection)) {
            Flash::error(__('messages.not_found', ['model' => __('models/connections.singular')]));

            return redirect(route('configuracion.connections.index'));
        }

        return view('configuracion.connections.edit')->with('connection', $connection);
    }

    /**
     * Update the specified Connection in storage.
     *
     * @param int $id
     * @param UpdateConnectionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConnectionRequest $request)
    {
        $connection = $this->connectionRepository->find($id);

        if (empty($connection)) {
            Flash::error(__('messages.not_found', ['model' => __('models/connections.singular')]));

            return redirect(route('configuracion.connections.index'));
        }

        $connection = $this->connectionRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/connections.singular')]));

        return redirect(route('configuracion.connections.index'));
    }

    /**
     * Remove the specified Connection from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $connection = $this->connectionRepository->find($id);

        if (empty($connection)) {
            Flash::error(__('messages.not_found', ['model' => __('models/connections.singular')]));

            return redirect(route('configuracion.connections.index'));
        }

        $this->connectionRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/connections.singular')]));

        return redirect(route('configuracion.connections.index'));
    }
}
