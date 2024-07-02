<?php

namespace App\Observers;

use App\Models\FeedBack;

class FeedBackObserver
{
    /**
     * Handle the FeedBack "created" event.
     */
    public function creating(FeedBack $feedBack): void
    {
        $media = ($feedBack->behavioral_respect_rating +
            $feedBack->behavioral_proactivity_rating +
            $feedBack->behavioral_excellence_rating +
            $feedBack->behavioral_innovation_rating +
            $feedBack->behavioral_flexibility_rating +
            $feedBack->behavioral_rules_rating) / 6;

        $feedBack->rating = intval(round($media, 2));
    }

    /**
     * Handle the FeedBack "updated" event.
     */
    public function updating(FeedBack $feedBack): void
    {
        $media = ($feedBack->behavioral_respect_rating +
            $feedBack->behavioral_proactivity_rating +
            $feedBack->behavioral_excellence_rating +
            $feedBack->behavioral_innovation_rating +
            $feedBack->behavioral_flexibility_rating +
            $feedBack->behavioral_rules_rating) / 6;

        $feedBack->rating = intval(round($media, 2));
    }


    /**
     * Handle the FeedBack "deleted" event.
     */
    public function deleted(FeedBack $feedBack): void
    {
        //
    }

    /**
     * Handle the FeedBack "restored" event.
     */
    public function restored(FeedBack $feedBack): void
    {
        //
    }

    /**
     * Handle the FeedBack "force deleted" event.
     */
    public function forceDeleted(FeedBack $feedBack): void
    {
        //
    }
}
