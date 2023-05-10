<div class="w-full p-2 md:p-4 max-w-lg">
    <x-lf.card class="success" title="Show">
        <table class="table">
            <tr>
                <th class="text-right pr-2">ID:</th>
                <td>{{ $data->id }}</td>
            </tr>

            <tr>
                <th class="text-right pr-2">name:</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">salary:</th>
                <td>{{ $data->salary }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">day:</th>
                <td>{{ $data->day }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">status:</th>
                <td>{{ $data->status }}</td>
            </tr>
        </table>
        <x-slot name="tools">
            @can('time-keep.applications.listing')
                <a class="btn-primary xs" href="{{ route('time-keep.applications') }}">{!! lfIcon('list', 11) !!}</a>
            @endcan
            @can('time-keep.applications.edit')
                <a class="btn-warning xs"
                    href="{{ route('time-keep.applications.edit', $data->id) }}">{!! lfIcon('edit', 11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can('time-keep.applications.listing')
                    <a class="btn-primary" href="{{ route('time-keep.applications') }}">{!! lfIcon('list') !!}
                        <span>Listing</span></a>
                @endcan
                <div>
                    @can('time-keep.applications.edit')
                        <a class="btn-warning"
                            href="{{ route('time-keep.applications.edit', $data->id) }}">{!! lfIcon('edit') !!}
                            <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
