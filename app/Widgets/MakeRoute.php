<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class MakeRoute extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'routeName' => '',
        'typeSort' => null,
        'direction_ask' => 'asc',
        'direction_desk' => 'desc'

    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.make_route', [
            'config' => $this->config,
        ]);
    }
}
