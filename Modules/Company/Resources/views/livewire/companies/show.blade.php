<div class="w-full p-2 md:p-4 max-w-lg" style="width: 600px;">
    <x-lf.card class="success" title="Show">
        <table class="table">
            <tr>
                <th class="text-right pr-2">ID:</th>
                <td>{{ $data->id }}</td>
            </tr>

            <tr>
                <th class="text-right pr-2">Tên công ty:</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">Slug:</th>
                <td>{{ $data->slug }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">Giới thiệu:</th>
                <td>{{ $data->teaser }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">Logo:</th>
                <td>
                    <img src="/{{ $data->logo->name }}" alt="" width="300px" height="300px">
                </td>
            </tr>
            <tr>
                <th class="text-right pr-2">Địa chỉ:</th>
                <td>{{ $data->address }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">Số điện thoại:</th>
                <td>{{ $data->phone }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">Thuộc công ty:</th>
                @if ($data->parent_id == 0)
                    <td>Không</td>
                @else
                    @foreach ($companies as $company)
                        @if ($company->id == $data->parent_id)
                            {{ $company->name }}
                        @endif
                    @endforeach
                @endif
            </tr>
            <tr>
                <th class="text-right pr-2">Trạng thái:</th>
                @if ($data->active == 0)
                    <td>Không hoạt động</td>
                @elseif($data->active == 1)
                    <td>Hoạt động</td>
                @endif
            </tr>
        </table>
        <x-slot name="tools">
            @can('company.companies.listing')
                <a class="btn-primary xs" href="{{ route('company.companies') }}">{!! lfIcon('list', 11) !!}</a>
            @endcan
            @can('company.companies.edit')
                <a class="btn-warning xs"
                    href="{{ route('company.companies.edit', $data->id) }}">{!! lfIcon('edit', 11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can('company.companies.listing')
                    <a class="btn-primary" href="{{ route('company.companies') }}">{!! lfIcon('list') !!}
                        <span>Listing</span></a>
                @endcan
                <div>
                    @can('company.companies.edit')
                        <a class="btn-warning"
                            href="{{ route('company.companies.edit', $data->id) }}">{!! lfIcon('edit') !!}
                            <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
