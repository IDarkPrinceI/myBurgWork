<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class LinksProduct extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'products' => ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.links_product', [
            'config' => $this->config,
        ]);
    }
}
