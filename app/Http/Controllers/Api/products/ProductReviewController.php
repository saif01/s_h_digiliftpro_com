<?php

namespace App\Http\Controllers\Api\products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function stats(Product $product)
    {
        $approved = $product->reviews()->where('status', 'approved');

        return response()->json([
            'product_id' => $product->id,
            'average' => (float) ($approved->avg('rating') ?? 0),
            'count' => (int) $approved->count(),
        ]);
    }

    public function index(Product $product)
    {
        $reviews = $product->reviews()
            ->where('status', 'approved')
            ->orderByDesc('approved_at')
            ->paginate(20);

        return response()->json($reviews);
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'reviewer_name' => 'nullable|string|max:255',
            'reviewer_email' => 'nullable|email|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string',
        ]);

        $review = ProductReview::create([
            'product_id' => $product->id,
            'user_id' => null,
            'reviewer_name' => $data['reviewer_name'] ?? null,
            'reviewer_email' => $data['reviewer_email'] ?? null,
            'rating' => $data['rating'],
            'title' => $data['title'] ?? null,
            'comment' => $data['comment'] ?? null,
            'status' => 'pending',
            'verified_purchase' => false,
        ]);

        return response()->json(['success' => true, 'review' => $review], 201);
    }

    public function markHelpful(Product $product, ProductReview $review)
    {
        if ($review->product_id !== $product->id) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->increment('helpful_count');
        return response()->json(['success' => true, 'helpful_count' => $review->helpful_count]);
    }

    // Admin endpoints
    public function allReviews(Request $request)
    {
        return response()->json(
            ProductReview::query()
                ->orderByDesc('created_at')
                ->paginate(50)
        );
    }

    public function approve(Product $product, ProductReview $review, Request $request)
    {
        if ($review->product_id !== $product->id) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->update([
            'status' => 'approved',
            'approved_by' => $request->user()?->id,
            'approved_at' => now(),
        ]);

        $product->updateRatingFromReviews();

        return response()->json(['success' => true, 'review' => $review]);
    }

    public function reject(Product $product, ProductReview $review)
    {
        if ($review->product_id !== $product->id) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->update([
            'status' => 'rejected',
            'approved_at' => null,
        ]);

        $product->updateRatingFromReviews();

        return response()->json(['success' => true, 'review' => $review]);
    }

    public function update(Request $request, Product $product, ProductReview $review)
    {
        if ($review->product_id !== $product->id) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $data = $request->validate([
            'rating' => 'nullable|numeric|min:0|max:5',
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        $data['updated_by'] = $request->user()?->id;
        $review->update($data);
        $product->updateRatingFromReviews();

        return response()->json(['success' => true, 'review' => $review]);
    }

    public function destroy(Product $product, ProductReview $review)
    {
        if ($review->product_id !== $product->id) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->delete();
        $product->updateRatingFromReviews();

        return response()->json(['success' => true]);
    }
}


