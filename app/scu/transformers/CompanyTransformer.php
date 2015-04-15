<?php

namespace Black\Transformers;

use League\Fractal\TransformerAbstract;
use Black\Models\Company;

class CompanyTransformer extends TransformerAbstract
{
      /**
     * List of resources possible to include
     *
     * @var array
     */
     protected $availableIncludes = array (
        'assets',
        'presentations',
        'teams',
        'users'
     );

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Company $company)
    {
        return array(
            'id'            => (int) $company->id,
            'name'          => $company->name,
            'address_1'     => $company->address_1,
            'address_2'     => $company->address_2,
            'city'          => $company->city,
            'state'         => $company->state,
            'zip'           => $company->zip_code,
            'phone'         => $company->phone,
            'owner_id'      => $company->owner_id,
            'created_at'    => $company->created_at,
            'updated_at'    => $company->updated_at,
            'deleted_at'    => $company->deleted_at,
            'links'         => [
                [
                    'rel' => 'self',
                    'uri' => '/companies' . '/' . $company->id,
                ],
                [
                    'rel' => 'companies.assets',
                    'uri' => '/companies' . '/' . $company->id . '/assets',
                ],
                [
                    'rel' => 'companies.presentations',
                    'uri' => '/companies' . '/' . $company->id . '/presentations',
                ],
                [
                    'rel' => 'companies.users',
                    'uri' => '/companies' . '/' . $company->id . '/users',
                ],
                [
                    'rel' => 'companies.teams',
                    'uri' => '/companies' . '/' . $company->id . '/teams',
                ]
            ]
        );
    }

    /**
     * Include assets
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeAssets(Company $company)
    {
        $assets = $company->assets;

        return $this->collection($assets, new AssetTransformer);
    }

    /**
     * Include Presentations
     *
     * @return League\Fractal\CollectionResource
     */
    public function includePresentations(Company $company)
    {
        $presentations = $company->presentations;

        return $this->collection($presentations, new PresentationTransformer);
    }

    /**
     * Include Teams
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeTeams(Company $company)
    {
        $teams = $company->teams;

        return $this->collection($teams, new TeamTransformer);
    }

    /**
     * Include Users
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeUsers(Company $company)
    {
        $users = $company->users;

        return $this->collection($users, new UserTransformer);
    }
}
