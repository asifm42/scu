<?php

namespace Black\Transformers;

use League\Fractal\TransformerAbstract;
use Black\Models\Slide;

class SlideTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
     protected $availableIncludes = array (
        'presentation'
     );

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Slide $slide)
    {
        return array(
            'id'                => (int) $slide->id,
            'presentation_id'   => (int) $slide->presentation_id,
            'sort_order'        => (int) $slide->sort_order,
            // 'title'             => $slide->title,
            'content'           => $slide->content,
            'config'            => $slide->config,
            'notes'             => $slide->notes,
            'created_at'        => $slide->created_at,
            'updated_at'        => $slide->updated_at,
            'deleted_at'        => $slide->deleted_at,
            'links'         => [
                [
                    'rel' => 'self',
                    'uri' => '/slides' . '/' . $slide->id,
                ],
                [
                    'rel' => 'slides.resources',
                    'uri' => '/slides' . '/' . $slide->id . '/resources',
                ],
                [
                    'rel' => 'presentation',
                    'uri' => '/presentations' . '/' . $slide->presentation_id,
                ]
            ]
        );
    }

    /**
     * Include Presentation
     *
     * @return League\Fractal\CollectionResource
     */
    public function includePresentation(Slide $slide)
    {
        $presentation = $slide->presentation;

        return $this->item($presentation, new PresentationTransformer);
    }
}