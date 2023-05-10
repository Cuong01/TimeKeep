<div class="w-full p-2 md:p-4 max-w-lg" style="width: 600px;">
    <x-lf.card class="success" title="Chi tiết">
        <table class="table">
            <tr>
                <th class="text-right pr-2">ID:</th>
                <td>{{ $data->id }}</td>
            </tr>

            <tr>
                <th class="text-right pr-2">Tên nhân viên:</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">Email:</th>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">Ảnh:</th>
                <td>
                    @if ($data->profile_photo_path)
                        <img src="/{{ json_decode($data->profile_photo_path)->name }}" alt="" width="200px"
                            height="200px">
                    @else
                        <img src="{{ $data->profile_photo_url }}" width="200px" height="200px">
                    @endif
                </td>
            </tr>
            <tr>
                <th class="text-right pr-2">is_admin:</th>
                <td>
                    @if ($data->is_admin == 0)
                        Người dùng
                    @elseif($data->is_admin == 1)
                        Admin
                    @endif
                </td>
            </tr>
            {{-- <tr>
                <th class="text-right pr-2">birthday:</th>
                <td>{{ $data->birthday }}</td>
            </tr> --}}
            <tr>
                <th class="text-right pr-2">Giới tính:</th>
                <td>
                    @if ($data->gender == 0)
                        Nam
                    @elseif($data->gender == 1)
                        Nữ
                    @elseif($data->gender == 2)
                        Khác
                    @endif
                </td>
            </tr>
            {{-- <tr>
                <th class="text-right pr-2">address:</th>
                <td>{{ $data->address }}</td>
            </tr>
            <tr>
                <th class="text-right pr-2">phone:</th>
                <td>{{ $data->phone }}</td>
            </tr> --}}
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
                <th class="text-right pr-2">Phòng ban:</th>
                <td>
                    @foreach ($departments as $dep)
                        @if ($data->department_id == $dep->id)
                            {{ $dep->name }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <th class="text-right pr-2">Chức vụ:</th>
                <td>
                    @foreach ($positions as $pos)
                        @if ($data->position_id == $pos->id)
                            {{ $pos->name }}
                        @endif
                    @endforeach
                </td>
            </tr>
            {{-- <tr>
                <th class="text-right pr-2">Mức độ:</th>
                <td>{{ $data->level }}</td>
            </tr> --}}
        </table>
        <x-slot name="tools">
            @can('company.users.listing')
                <a class="btn-primary xs" href="{{ route('company.users') }}">{!! lfIcon('list', 11) !!}</a>
            @endcan
            @can('company.users.edit')
                <a class="btn-warning xs" href="{{ route('company.users.edit', $data->id) }}">{!! lfIcon('edit', 11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can('company.users.listing')
                    <a class="btn-primary" href="{{ route('company.users') }}">{!! lfIcon('list') !!}
                        <span>Listing</span></a>
                @endcan
                <div>
                    @can('company.users.edit')
                        <a class="btn-warning" href="{{ route('company.users.edit', $data->id) }}">{!! lfIcon('edit') !!}
                            <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
