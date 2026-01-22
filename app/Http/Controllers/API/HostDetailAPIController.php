<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHostDetailAPIRequest;
use App\Http\Requests\API\UpdateHostDetailAPIRequest;
use App\Models\HostDetail;
use App\Repositories\HostDetailRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class HostDetailAPIController
 */
class HostDetailAPIController extends AppBaseController
{
    private HostDetailRepository $hostDetailRepository;

    public function __construct(HostDetailRepository $hostDetailRepo)
    {
        $this->hostDetailRepository = $hostDetailRepo;
    }

    /**
     * Display a listing of the HostDetails.
     * GET|HEAD /host-details
     */
    public function index(Request $request): JsonResponse
    {
        $hostDetails = $this->hostDetailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($hostDetails->toArray(), 'Host Details retrieved successfully');
    }

    /**
     * Store a newly created HostDetail in storage.
     * POST /host-details
     */
    public function store(CreateHostDetailAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $hostDetail = $this->hostDetailRepository->create($input);

        return $this->sendResponse($hostDetail->toArray(), 'Host Detail saved successfully');
    }

    /**
     * Display the specified HostDetail.
     * GET|HEAD /host-details/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var HostDetail $hostDetail */
        $hostDetail = $this->hostDetailRepository->find($id);

        if (empty($hostDetail)) {
            return $this->sendError('Host Detail not found');
        }

        return $this->sendResponse($hostDetail->toArray(), 'Host Detail retrieved successfully');
    }

    /**
     * Update the specified HostDetail in storage.
     * PUT/PATCH /host-details/{id}
     */
    public function update($id, UpdateHostDetailAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var HostDetail $hostDetail */
        $hostDetail = $this->hostDetailRepository->find($id);

        if (empty($hostDetail)) {
            return $this->sendError('Host Detail not found');
        }

        $hostDetail = $this->hostDetailRepository->update($input, $id);

        return $this->sendResponse($hostDetail->toArray(), 'HostDetail updated successfully');
    }

    /**
     * Remove the specified HostDetail from storage.
     * DELETE /host-details/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var HostDetail $hostDetail */
        $hostDetail = $this->hostDetailRepository->find($id);

        if (empty($hostDetail)) {
            return $this->sendError('Host Detail not found');
        }

        $hostDetail->delete();

        return $this->sendSuccess('Host Detail deleted successfully');
    }
}
