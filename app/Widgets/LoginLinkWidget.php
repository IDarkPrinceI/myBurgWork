<?php

namespace App\Widgets;

use App\Models\User;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;

class LoginLinkWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'userRole' => 'guest'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */

    public function run()
    {
        //

        return view('widgets.login_link_widget', [
            'config' => $this->config,
        ]);
    }
}
