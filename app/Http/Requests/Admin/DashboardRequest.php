<?php

namespace App\Http\Requests\Admin;

use App\Rules\DateDiffAllowedRule;
use App\Rules\DateRangeFormatRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DashboardRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'date_range' => ['bail','nullable', new DateRangeFormatRule(), new DateDiffAllowedRule()]
        ];
    }
}
