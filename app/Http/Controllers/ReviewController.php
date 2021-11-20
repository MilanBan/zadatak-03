<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function destroy($id) {
        $review = Review::find($id);
        if(!$review) return response()->error("Review does not exist.", 404);

        if(in_array(auth('sanctum')->user()->role_id, array('2','1')) || $review->mentor->id == $review->mentor_id) {
            $review->delete();
        }else{
            return response()->error("You don't have permission delete this review.", 403);
        }
        
    }
}
