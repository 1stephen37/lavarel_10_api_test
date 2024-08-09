<?php

namespace App\Http\Controllers;

use App\Models\ReviewsModel;
use App\Utilities\HttpStatusCode;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $reviews = ReviewsModel::with(['user' => function ($query) {
                $query->select('id', 'name');
            }])->get();
            return response()->json([
                "data" => $reviews
            ], HttpStatusCode::SUCCESS);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ], HttpStatusCode::INTERNAL_SERVER_ERROR);
        }
    }

    public function create_review(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'id_user' => 'required|exists:users,id',
                'content' => 'required|string',
            ]);

            $review = new ReviewsModel($validatedData);
            $review->save();

            return response()->json([
                'data' => $review
            ], 201); // HTTP 201 Created
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ], HttpStatusCode::INTERNAL_SERVER_ERROR);
        }
    }

    public function delete_review($id): JsonResponse
    {
        try {
            $review = ReviewsModel::destroy($id);
            if ($review) {
                return response()->json([
                    'message' => 'Review deleted successfully.'
                ], HttpStatusCode::SUCCESS);
            } else {
                return response()->json([
                    'error' => 'Không tìm thấy review có id ' . $id
                ], HttpStatusCode::NOT_FOUND);
            }
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ], HttpStatusCode::INTERNAL_SERVER_ERROR);
        }
    }

    public function update_review(Request $request, $id): JsonResponse
    {
        try {
            $review = ReviewsModel::find($id);

            if ($review) {
                $validatedData = $request->validate([
                    'content' => 'required|string',
                ]);

                $review->update($validatedData);
                return response()->json([
                    'data' => $review
                ], HttpStatusCode::SUCCESS);
            } else {
                return response()->json([
                    "error" => "Không tìm thấy review có id " . $id,
                ], HttpStatusCode::NOT_FOUND);
            }

        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ], HttpStatusCode::INTERNAL_SERVER_ERROR);
        }

    }

}
