<?php

namespace Black\Transformers;

use League\Fractal\TransformerAbstract;
use Black\Models\User;

class UserTransformer extends TransformerAbstract
{

      /**
     * List of resources possible to include
     *
     * @var array
     */
     protected $availableIncludes = array (
        'presentations',
        'ownedPresentations',
        'teams'
     );

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(User $user)
    {
        return array(
            'id'            => (int) $user->id,
            'email'         => $user->email,
            'first_name'    => $user->first_name,
            'last_name'     => $user->last_name,
            'title'         => $user->title,
            'created_at'    => $user->created_at,
            'updated_at'    => $user->updated_at,
            'deleted_at'    => $user->deleted_at,
            'links'         => [
                [
                    'rel' => 'self',
                    'uri' => '/users' . '/' . $user->id,
                ],
                [
                    'rel' => 'users.ownedPresentations',
                    'uri' => '/users' . '/' . $user->id . '/ownedPresentations',
                ],
                [
                    'rel' => 'users.presentations',
                    'uri' => '/users' . '/' . $user->id . '/presentations',
                ]
            ]
        );
    }

    /**
     * Include Owned Presentations
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeOwnedPresentations(User $user)
    {
        $presentations = $user->ownedPresentations;

        return $this->collection($presentations, new PresentationTransformer);
    }

    /**
     * Include Presentations
     *
     * @return League\Fractal\CollectionResource
     */
    public function includePresentations(User $user)
    {
        $presentations = $user->presentations;

        return $this->collection($presentations, new PresentationTransformer);
    }

    /**
     * Include Teams
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeTeams(User $user)
    {
        $teams = $user->teams;

        return $this->collection($teams, new TeamTransformer);
    }

}
