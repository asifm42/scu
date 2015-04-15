<?php

namespace Black\Transformers;

use League\Fractal\TransformerAbstract;
use Black\Models\Presentation;

class PresentationTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = array (
        'slides',
        'owner',
        'users'
    );

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Presentation $presentation)
    {
        return array(
            'id'            => (int) $presentation->id,
            'owner_id'      => (int) $presentation->owner_id,
            'title'         => $presentation->title,
            'description'   => $presentation->description,
            'config'        => $presentation->config,
            'view_count'    => (int) $presentation->publview_countic,
            'public'        => (boolean) $presentation->public,
            'locked'        => (boolean) $presentation->locked,
            'tags'          => $presentation->tagNames(),
            'created_at'    => $presentation->created_at,
            'updated_at'    => $presentation->updated_at,
            'deleted_at'    => $presentation->deleted_at,
            'links'         => [
                [
                    'rel' => 'self',
                    'uri' => '/presentations' . '/' . $presentation->id,
                ],
                [
                    'rel' => 'owner',
                    'uri' => '/users' . '/' . $presentation->owner_id,
                ],
                [
                    'rel' => 'presentations.users',
                    'uri' => '/presentations' . '/' . $presentation->id . '/users',
                ]
            ]
        );
    }

    /**
     * Include Slides
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeSlides(Presentation $presentation)
    {
        $slides = $presentation->slides;

        return $this->Collection($slides, new SlideTransformer);
    }

    /**
     * Include Owner
     *
     * @return League\Fractal\ItemResource
     */
    public function includeOwner(Presentation $presentation)
    {
        $owner = $presentation->owner;

        return $this->Item($owner, new UserTransformer);
    }

    /**
     * Include Users
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeUsers(Presentation $presentation)
    {
        $users = $presentation->users;

        return $this->Collection($users, new UserTransformer);
    }
}
