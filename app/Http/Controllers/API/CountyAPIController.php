<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCountyAPIRequest;
use App\Http\Requests\API\UpdateCountyAPIRequest;
use App\Models\County;
use App\Repositories\CountyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CountyAPIController
 */
class CountyAPIController extends AppBaseController
{
    private CountyRepository $countyRepository;

    public function __construct(CountyRepository $countyRepo)
    {
        $this->countyRepository = $countyRepo;
    }

    /**
     * Display a listing of the Counties.
     * GET|HEAD /counties
     */
    public function index(Request $request): JsonResponse
    {
        $counties = $this->countyRepository->with(['areas'])->paginate(20);

        return $this->sendResponse($counties->toArray(), 'Counties retrieved successfully');
    }

    /**
     * Store a newly created County in storage.
     * POST /counties
     */
    public function store(CreateCountyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $county = $this->countyRepository->create($input);

        return $this->sendResponse($county->toArray(), 'County saved successfully');
    }

    /**
     * Display the specified County.
     * GET|HEAD /counties/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var County $county */
        $county = $this->countyRepository->find($id);

        if (empty($county)) {
            return $this->sendError('County not found');
        }

        return $this->sendResponse($county->toArray(), 'County retrieved successfully');
    }

    /**
     * Update the specified County in storage.
     * PUT/PATCH /counties/{id}
     */
    public function update($id, UpdateCountyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var County $county */
        $county = $this->countyRepository->find($id);

        if (empty($county)) {
            return $this->sendError('County not found');
        }

        $county = $this->countyRepository->update($input, $id);

        return $this->sendResponse($county->toArray(), 'County updated successfully');
    }

    /**
     * Remove the specified County from storage.
     * DELETE /counties/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var County $county */
        $county = $this->countyRepository->find($id);

        if (empty($county)) {
            return $this->sendError('County not found');
        }

        $county->delete();

        return $this->sendSuccess('County deleted successfully');
    }
}
