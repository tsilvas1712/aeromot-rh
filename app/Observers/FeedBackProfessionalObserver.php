<?php

namespace App\Observers;

use App\Models\FeedBackProfessional;

class FeedBackProfessionalObserver
{
    /**
     * Handle the FeedBackProfessional "created" event.
     */
    public function creating(FeedBackProfessional $feedBackProfessional): void
    {
        $media = ($feedBackProfessional->receptive_leader_rating +
            $feedBackProfessional->receive_feedback_rating +
            $feedBackProfessional->answers_questions_rating +
            $feedBackProfessional->comunication_rating +
            $feedBackProfessional->trust_rating +
            $feedBackProfessional->team_development_rating +
            $feedBackProfessional->autonomy_rating +
            $feedBackProfessional->healthy_relationship_rating) / 8;

        $feedBackProfessional->rating = intval(round($media, 2));

        $feedBackProfessional->staf_id = auth()->user()->id;
    }

    /**
     * Handle the FeedBackProfessional "updated" event.
     */
    public function updating(FeedBackProfessional $feedBackProfessional): void
    {
        $media = ($feedBackProfessional->receptive_leader_rating +
            $feedBackProfessional->receive_feedback_rating +
            $feedBackProfessional->answers_questions_rating +
            $feedBackProfessional->comunication_rating +
            $feedBackProfessional->trust_rating +
            $feedBackProfessional->team_development_rating +
            $feedBackProfessional->autonomy_rating +
            $feedBackProfessional->healthy_relationship_rating) / 8;

        $feedBackProfessional->rating = intval(round($media, 2));

        $feedBackProfessional->staf_id = auth()->user()->id;
    }

    /**
     * Handle the FeedBackProfessional "deleted" event.
     */
    public function deleted(FeedBackProfessional $feedBackProfessional): void
    {
        //
    }

    /**
     * Handle the FeedBackProfessional "restored" event.
     */
    public function restored(FeedBackProfessional $feedBackProfessional): void
    {
        //
    }

    /**
     * Handle the FeedBackProfessional "force deleted" event.
     */
    public function forceDeleted(FeedBackProfessional $feedBackProfessional): void
    {
        //
    }
}
