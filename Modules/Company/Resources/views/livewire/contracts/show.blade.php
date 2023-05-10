<div class="w-full p-2 md:p-4 max-w-lg">
    <x-lf.card class="success" title="Chi tiết">
        <table class="table">
            <tr>
                <th class="text-right pr-2">ID:</th>
                <td>{{ $data->id }}</td>
            </tr>

            <tr>
                <th class="text-right pr-2">user_id:</th>
                <td>{{ $data->user_id }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">name:</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">some_contracts:</th>
                <td>{{ $data->some_contracts }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">sign_day:</th>
                <td>{{ $data->sign_day }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">type:</th>
                <td>{{ $data->type }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">effective_date:</th>
                <td>{{ $data->effective_date }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">expiration_date:</th>
                <td>{{ $data->expiration_date }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">type_of_work:</th>
                <td>{{ $data->type_of_work }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">rank:</th>
                <td>{{ $data->rank }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">total_salary:</th>
                <td>{{ $data->total_salary }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">salary_received:</th>
                <td>{{ $data->salary_received }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">basic_salary:</th>
                <td>{{ $data->basic_salary }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">pay_forms:</th>
                <td>{{ $data->pay_forms }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">salary_paid_for_insurance:</th>
                <td>{{ $data->salary_paid_for_insurance }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">salary_percentage:</th>
                <td>{{ $data->salary_percentage }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">salary_allowance:</th>
                <td>{{ $data->salary_allowance }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">signed_representative:</th>
                <td>{{ $data->signed_representative }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">position_id:</th>
                <td>{{ $data->position_id }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">note:</th>
                <td>{{ $data->note }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">file:</th>
                <td>{{ $data->file }}</td>
            </tr>
        </table>
        <x-slot name="tools">
            @can('company.contracts.listing')
                <a class="btn-primary xs" href="{{ route('company.contracts') }}">{!! lfIcon('list', 11) !!}</a>
            @endcan
            @can('company.contracts.edit')
                <a class="btn-warning xs"
                    href="{{ route('company.contracts.edit', $data->id) }}">{!! lfIcon('edit', 11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can('company.contracts.listing')
                    <a class="btn-primary" href="{{ route('company.contracts') }}">{!! lfIcon('list') !!}
                        <span>Listing</span></a>
                @endcan
                <div>
                    @can('company.contracts.edit')
                        <a class="btn-warning"
                            href="{{ route('company.contracts.edit', $data->id) }}">{!! lfIcon('edit') !!}
                            <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
