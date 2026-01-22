<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAirbnbAPIRequest;
use App\Http\Requests\API\UpdateAirbnbAPIRequest;
use App\Models\Airbnb;
use App\Repositories\AirbnbRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AirbnbAPIController
 */
class AirbnbAPIController extends AppBaseController
{
    private AirbnbRepository $airbnbRepository;

    public function __construct(AirbnbRepository $airbnbRepo)
    {
        $this->airbnbRepository = $airbnbRepo;
    }

    /**
     * Display a listing of the Airbnbs.
     * GET|HEAD /airbnbs
     */
    public function index(Request $request): JsonResponse
    {
        $query = $this->airbnbRepository->model()::with(['area.county','host','roomType']);
        
        if ($request->has('area_id') && $request->area_id) {
            $query->where('area_id', $request->area_id);
        }
        
        $airbnbs = $query->paginate(20);

        return $this->sendResponse($airbnbs->toArray(), 'Airbnbs retrieved successfully');
    }

    /**
     * Store a newly created Airbnb in storage.
     * POST /airbnbs
     */
    public function store(CreateAirbnbAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $airbnb = $this->airbnbRepository->create($input);

        return $this->sendResponse($airbnb->toArray(), 'Airbnb saved successfully');
    }

    /**
     * Display the specified Airbnb.
     * GET|HEAD /airbnbs/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Airbnb $airbnb */
        $airbnb = Airbnb::with(['area.county','host','roomType'])->find($id);

        if (empty($airbnb)) {
            return $this->sendError('Airbnb not found');
        }

        return $this->sendResponse($airbnb->toArray(), 'Airbnb retrieved successfully');
    }

    /**
     * Update the specified Airbnb in storage.
     * PUT/PATCH /airbnbs/{id}
     */
    public function update($id, UpdateAirbnbAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Airbnb $airbnb */
        $airbnb = $this->airbnbRepository->find($id);

        if (empty($airbnb)) {
            return $this->sendError('Airbnb not found');
        }

        $airbnb = $this->airbnbRepository->update($input, $id);

        return $this->sendResponse($airbnb->toArray(), 'Airbnb updated successfully');
    }

    /**
     * Remove the specified Airbnb from storage.
     * DELETE /airbnbs/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Airbnb $airbnb */
        $airbnb = $this->airbnbRepository->find($id);

        if (empty($airbnb)) {
            return $this->sendError('Airbnb not found');
        }

        $airbnb->delete();

        return $this->sendSuccess('Airbnb deleted successfully');
    }
}
