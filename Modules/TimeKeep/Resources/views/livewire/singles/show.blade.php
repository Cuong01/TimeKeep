<div class="w-full p-2 md:p-4 max-w-lg">
    <x-lf.card class="success" title="Chi tiết">
        @if ($data->type == 1)
            <table class="table">
                <tr>
                    <th class="text-right pr-2">Mã nhân viên:</th>
                    <td>{{ $data->user_id }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Tên nhân viên:</th>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Công ty:</th>
                    <td>
                        @foreach ($companies as $com)
                            @if ($com->id == $data->company_id)
                                {{ $com->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Loại nghỉ:</th>
                    <td>

                        @foreach ($appli as $item)
                            @if (json_decode($data->value)->appli_id == $item->id)
                                {{ $item->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Phần trăm lương:</th>
                    <td>{{ json_decode($data->value)->count }}%</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Số ngày nghỉ tối đa:</th>
                    <td>{{ json_decode($data->value)->day_max }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Nghỉ từ ngày:</th>
                    <td>{{ json_decode($data->value)->from }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Đến ngày:</th>
                    <td>{{ json_decode($data->value)->to }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Lý do:</th>
                    <td>{{ $data->reason }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Người duyệt đơn:</th>
                    <td>
                        @foreach ($users as $user)
                            @if ($user->id == $data->censor)
                                {{ $user->name }}
                            @else
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Trạng thái</th>
                    <td>
                        @if ($data->status == 0)
                            Đang chờ duyệt
                        @elseif($data->status == 1)
                            Đã duyệt
                        @elseif($data->status == 2)
                            Từ chối
                        @endif
                    </td>
                </tr>
            </table>
        @elseif($data->type == 2)
            <table class="table">
                <tr>
                    <th class="text-right pr-2">Mã nhân viên:</th>
                    <td>{{ $data->user_id }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Tên nhân viên:</th>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Công ty:</th>
                    <td>
                        @foreach ($companies as $com)
                            @if ($com->id == $data->company_id)
                                {{ $com->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Ngày áp dụng:</th>
                    <td>{{ json_decode($data->value)->day_apply }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Đi muộn số phút:</th>
                    <td>{{ json_decode($data->value)->late }} phút</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Về sớm số phút:</th>
                    <td>{{ json_decode($data->value)->soon }} phút</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Lý do:</th>
                    <td>{{ $data->reason }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Người duyệt đơn:</th>
                    <td>
                        @foreach ($users as $user)
                            @if ($user->id == $data->censor)
                                {{ $user->name }}
                            @else
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Trạng thái</th>
                    <td>
                        @if ($data->status == 0)
                            Đang chờ duyệt
                        @elseif($data->status == 1)
                            Đã duyệt
                        @elseif($data->status == 2)
                            Từ chối
                        @endif
                    </td>
                </tr>
            </table>
        @elseif($data->type == 3)
            <table class="table">
                <tr>
                    <th class="text-right pr-2">Mã nhân viên:</th>
                    <td>{{ $data->user_id }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Tên nhân viên:</th>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Công ty:</th>
                    <td>
                        @foreach ($companies as $com)
                            @if ($com->id == $data->company_id)
                                {{ $com->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Ngày lễ:</th>
                    <td>
                        @foreach ($holiday as $item1)
                            @if (json_decode($data->value)->holiday_id == $item1->id)
                                {{ $item1->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Từ ngày:</th>
                    <td>{{ json_decode($data->value)->from_day }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Đến ngày:</th>
                    <td>{{ json_decode($data->value)->to_day }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Phần trăm lương</th>
                    <td>{{ json_decode($data->value)->salary_working }} %</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Lý do:</th>
                    <td>{{ $data->reason }}</td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Người duyệt đơn:</th>
                    <td>
                        @foreach ($users as $user)
                            @if ($user->id == $data->censor)
                                {{ $user->name }}
                            @else
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="text-right pr-2">Trạng thái</th>
                    <td>
                        @if ($data->status == 0)
                            Đang chờ duyệt
                        @elseif($data->status == 1)
                            Đã duyệt
                        @elseif($data->status == 2)
                            Từ chối
                        @endif
                    </td>
                </tr>
            </table>
        @endif

        <x-slot name="tools">
            @can('time-keep.singles.listing')
                <a class="btn-primary xs" href="{{ route('time-keep.singles') }}">{!! lfIcon('list', 11) !!}</a>
            @endcan
            @can('time-keep.singles.edit')
                <a class="btn-warning xs"
                    href="{{ route('time-keep.singles.edit', $data->id) }}">{!! lfIcon('edit', 11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can('time-keep.singles.listing')
                    <a class="btn-primary" href="{{ route('time-keep.singles') }}">{!! lfIcon('list') !!}
                        <span>Listing</span></a>
                @endcan
                <div>
                    @can('time-keep.singles.edit')
                        <a class="btn-warning"
                            href="{{ route('time-keep.singles.edit', $data->id) }}">{!! lfIcon('edit') !!}
                            <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
