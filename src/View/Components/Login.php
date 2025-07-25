<?php declare(strict_types=1);

namespace Irkz\Crminfo\View\Components;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Login extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): \Illuminate\Contracts\View\View
    {
        try {
            $data = json_decode(
                Storage::disk(config('crm-info.storage'))->get(config('crm-info.fileName')),
                true
            );

            return view('crm-info::components.v1.login', [
                ...$data['data'],
                'isError' => false,
            ]);
        } catch (\Throwable $throwable) {
            // Ничего не делаем при ошибке
        }

        return view('crm-info::components.v1.login', [
            'isError' => true,
        ]);
    }
}
