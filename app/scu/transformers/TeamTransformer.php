<?php

namespace Black\Transformers;

use League\Fractal\TransformerAbstract;
use Black\Models\Team;



/************
*
*
*  Need to update this. was copied from assets.
*
*
***********/







class TeamTransformer extends TransformerAbstract
{
      /**
     * List of resources possible to include
     *
     * @var array
     */
     protected $availableIncludes = array (
        'company',
        'presentations',
        'slides',
        'teams',
        'users'
     );

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Team $team)
    {
        return array(
            'id'                => (int) $team->id,
            'name'              => $team->name,
            'description'       => $team->description,
            'organization_id'   => (int) $team->organization_id,
            'created_at'        => $team->created_at,
            'updated_at'        => $team->updated_at,
            'deleted_at'        => $team->deleted_at,
            'links'             => [
                [
                    'rel' => 'self',
                    'uri' => '/teams' . '/' . $team->id,
                ],
                [
                    'rel' => 'teams.assets',
                    'uri' => '/teams' . '/' . $team->id . '/assets',
                ],
                [
                    'rel' => 'teams.company',
                    'uri' => '/teams' . '/' . $team->id . '/company',
                ],
                [
                    'rel' => 'teams.presentations',
                    'uri' => '/teams' . '/' . $team->id . '/presentations',
                ],
                [
                    'rel' => 'teams.slides',
                    'uri' => '/teams' . '/' . $team->id . '/slides',
                ],
                [
                    'rel' => 'teams.users',
                    'uri' => '/teams' . '/' . $team->id . '/users',
                ]
            ]
        );
    }

    /**
     * Include Company
     *
     * @return League\Fractal\ItemResource
     */
    public function includeCompany(Team $team)
    {
        $company = $team->company;

        return $this->item($company, new CompanyTransformer);
    }

    /**
     * Include Presentations
     *
     * @return League\Fractal\CollectionResource
     */
    public function includePresentations(Team $team)
    {
        $presentations = $team->presentations;

        return $this->collection($presentations, new PresentationTransformer);
    }

    /**
     * Include Slides
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeTeams(Team $team)
    {
        $slides = $team->slides;

        return $this->collection($slides, new SlideTransformer);
    }

    /**
     * Include Teams
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeAssets(Team $team)
    {
        $teams = $team->assets;

        return $this->collection($assets, new AssetTransformer);
    }

    /**
     * Include Users
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeUsers(Team $team)
    {
        $users = $team->users;

        return $this->collection($users, new UserTransformer);
    }
}
