<?php

namespace Black\Transformers;

use League\Fractal\TransformerAbstract;
use Black\Models\Resource;

class ResourceTransformer extends TransformerAbstract
{
      /**
     * List of resources possible to include
     *
     * @var array
     */
     protected $availableIncludes = array (
        'users'
     );

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Resource $resource)
    {
        return array(
            'id'            => (int) $resource->id,
            'filename'      => $resource->original_file_name,
            'display_name'  => $resource->display_name,
            'description'   => $resource->description,
            'filetype'      => $resource->file_type,
            'filesize'      => $resource->file_size,
            'duration'      => $resource->duration,
            'height'        => $resource->height,
            'width'         => $resource->width,
            'created_at'    => $resource->created_at,
            'updated_at'    => $resource->updated_at,
            'deleted_at'    => $resource->deleted_at,
            'links'         => [
                [
                    'rel' => 'self',
                    'uri' => '/resources' . '/' . $resource->id,
                ]//,
            //     [
            //         'rel' => 'assets.company',
            //         'uri' => '/assets' . '/' . $resource->id . '/company',
            //     ],
            //     [
            //         'rel' => 'assets.presentations',
            //         'uri' => '/assets' . '/' . $resource->id . '/presentations',
            //     ],
            //     [
            //         'rel' => 'assets.slides',
            //         'uri' => '/assets' . '/' . $resource->id . '/slides',
            //     ],
            //     [
            //         'rel' => 'assets.teams',
            //         'uri' => '/assets' . '/' . $resource->id . '/teams',
            //     ],
            //     [
            //         'rel' => 'assets.users',
            //         'uri' => '/assets' . '/' . $resource->id . '/users',
            //     ],
                // [
                //     'rel' => 'resources.owner',
                //     'uri' => '/assets' . '/' . $resource->id . '/owner',
                // ]
            ]
        );
    }

    /**
     * Include Company
     *
     * @return League\Fractal\ItemResource
     */
    public function includeCompany(Resource $resource)
    {
        $company = $resource->company;

        return $this->item($company, new CompanyTransformer);
    }

    /**
     * Include Presentations
     *
     * @return League\Fractal\CollectionResource
     */
    public function includePresentations(Resource $resource)
    {
        $presentations = $resource->presentations;

        return $this->collection($presentations, new PresentationTransformer);
    }

    /**
     * Include Slides
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeSlides(Resource $resource)
    {
        $slides = $resource->slides;

        return $this->collection($slides, new SlideTransformer);
    }

    /**
     * Include Teams
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeTeams(Resource $resource)
    {
        $teams = $resource->teams;

        return $this->collection($teams, new TeamTransformer);
    }

    /**
     * Include Users
     *
     * @return League\Fractal\CollectionResource
     */
    public function includeUsers(Resource $resource)
    {
        $users = $resource->users;

        return $this->collection($users, new UserTransformer);
    }
}
