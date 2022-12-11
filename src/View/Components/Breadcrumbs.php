<?php

namespace Esign\Breadcrumbs\View\Components;

use Esign\Breadcrumbs\Facades\Breadcrumbs as BreadcrumbsFacade;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public function render()
    {
        return view('breadcrumbs::components.breadcrumbs', [
            'breadcrumbs' => BreadcrumbsFacade::get(),
        ]);
    }
}
