<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRoomTypeAPIRequest;
use App\Http\Requests\API\UpdateRoomTypeAPIRequest;
use App\Models\RoomType;
use App\Repositories\RoomTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class RoomTypeAPIController
 */
class RoomTypeAPIController extends AppBaseController
{
    private RoomTypeRepository $roomTypeRepository;

    public function __construct(RoomTypeRepository $roomTypeRepo)
    {
        $this->roomTypeRepository = $roomTypeRepo;
    }

    /**
     * Display a listing of the RoomTypes.
     * GET|HEAD /room-types
     */
    public function index(Request $request): JsonResponse
    {
        $roomTypes = $this->roomTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($roomTypes->toArray(), 'Room Types retrieved successfully');
    }

    /**
     * Store a newly created RoomType in storage.
     * POST /room-types
     */
    public function store(CreateRoomTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $roomType = $this->roomTypeRepository->create($input);

        return $this->sendResponse($roomType->toArray(), 'Room Type saved successfully');
    }

    /**
     * Display the specified RoomType.
     * GET|HEAD /room-types/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var RoomType $roomType */
        $roomType = $this->roomTypeRepository->find($id);

        if (empty($roomType)) {
            return $this->sendError('Room Type not found');
        }

        return $this->sendResponse($roomType->toArray(), 'Room Type retrieved successfully');
    }

    /**
     * Update the specified RoomType in storage.
     * PUT/PATCH /room-types/{id}
     */
    public function update($id, UpdateRoomTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var RoomType $roomType */
        $roomType = $this->roomTypeRepository->find($id);

        if (empty($roomType)) {
            return $this->sendError('Room Type not found');
        }

        $roomType = $this->roomTypeRepository->update($input, $id);

        return $this->sendResponse($roomType->toArray(), 'RoomType updated successfully');
    }

    /**
     * Remove the specified RoomType from storage.
     * DELETE /room-types/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var RoomType $roomType */
        $roomType = $this->roomTypeRepository->find($id);

        if (empty($roomType)) {
            return $this->sendError('Room Type not found');
        }

        $roomType->delete();

        return $this->sendSuccess('Room Type deleted successfully');
    }
}
