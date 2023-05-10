<div class="w-full p-2 md:p-4 max-w-lg" style="width: 600px;">
    <x-lf.card class="success" title="Chi tiết">
        <table class="table">
            <tr>
                <th class="text-right pr-2">ID:</th>
                <td>{{ $data->id }}</td>
            </tr>

            <tr>
                <th class="text-right pr-2">Tên phòng ban:</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">Công ty:</th>
                <td>
                    @foreach ($companies as $com)
                        @if ($data->company_id == $com->id)
                            {{ $com->name }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <th class="text-right pr-2">Thuộc phòng ban:</th>
                @if ($data->parent_id == 0)
                    <td>Không</td>
                @else
                    @foreach ($departments as $department)
                        @if ($department->id == $data->parent_id)
                            <td>{{ $department->name }}</td>
                        @endif
                    @endforeach
                @endif
            </tr>
            {{-- <tr>
				<th class="text-right pr-2">root_id:</th>
				<td>{{$data->root_id}}</td>
			</tr> --}}
        </table>
        <x-slot name="tools">
            @can('company.departments.listing')
                <a class="btn-primary xs" href="{{ route('company.departments') }}">{!! lfIcon('list', 11) !!}</a>
            @endcan
            @can('company.departments.edit')
                <a class="btn-warning xs"
                    href="{{ route('company.departments.edit', $data->id) }}">{!! lfIcon('edit', 11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can('company.departments.listing')
                    <a class="btn-primary" href="{{ route('company.departments') }}">{!! lfIcon('list') !!}
                        <span>Listing</span></a>
                @endcan
                <div>
                    @can('company.departments.edit')
                        <a class="btn-warning"
                            href="{{ route('company.departments.edit', $data->id) }}">{!! lfIcon('edit') !!}
                            <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
