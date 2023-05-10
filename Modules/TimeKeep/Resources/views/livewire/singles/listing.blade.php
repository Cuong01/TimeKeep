<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
                </th>
                <x-lf.table.label name="user_id" :fields="$fields">Mã nhân viên</x-lf.table.label>
                <x-lf.table.label name="name" :fields="$fields">Tên nhân viên</x-lf.table.label>
                <x-lf.table.label name="company_id" :fields="$fields">Công ty</x-lf.table.label>
                <x-lf.table.label name="type" :fields="$fields">Loại đơn</x-lf.table.label>
                {{-- <x-lf.table.label name="value" :fields="$fields">Value</x-lf.table.label> --}}
                <x-lf.table.label name="reason" :fields="$fields">Lý do</x-lf.table.label>
                <x-lf.table.label name="censor" :fields="$fields">Người duyệt đơn</x-lf.table.label>
                <x-lf.table.label name="status" :fields="$fields">Trạng thái</x-lf.table.label>
                <x-lf.table.label name="created_at" :fields="$fields">Ngày gửi đơn</x-lf.table.label>
                {{-- <x-lf.table.label name="updated_at" :fields="$fields">Updated At</x-lf.table.label> --}}

                <th></th>
            </tr>
        </thead>
        @foreach ($data as $item)
            <tr>
                <th class="stt">{{ $item->id }}</th>
                <x-lf.table.item name="user_id" :fields="$fields">{{ $item->user_id }}</x-lf.table.item>
                <x-lf.table.item name="name" :fields="$fields">{{ $item->name }}</x-lf.table.item>
                <x-lf.table.item name="company_id" :fields="$fields">
                    {{-- {{ $item->company_id }} --}}
                    @foreach ($companies as $com)
                        @if ($com->id == $item->company_id)
                            {{ $com->name }}
                        @endif
                    @endforeach
                </x-lf.table.item>
                <x-lf.table.item name="type" :fields="$fields">
                    @if ($item->type == 1)
                        Đơn xin nghỉ
                    @elseif($item->type == 2)
                        Đơn xin đi muộn về sớm
                    @elseif($item->type == 3)
                        Đơn đăng ký đi làm ngày lễ
                    @endif
                </x-lf.table.item>
                <x-lf.table.item name="reason" :fields="$fields">{{ $item->reason }}</x-lf.table.item>
                <x-lf.table.item name="censor" :fields="$fields">
                    {{-- {{ $item->censor }} --}}
                    @foreach ($users as $user)
                        @if ($user->id == $item->censor)
                            {{ $user->name }}
                        @else
                        @endif
                    @endforeach
                </x-lf.table.item>
                {{-- <x-lf.table.item name="value" :fields="$fields">{{ $item->value }}</x-lf.table.item> --}}
                <x-lf.table.item name="status" :fields="$fields">
                    {{-- {{ $item->status }} --}}
                    @if ($item->status == 0)
                        <label style="background-color: rgb(242, 255, 0)">Đang chờ duyệt</label>
                    @elseif($item->status == 1)
                        <label style="background-color: rgb(26, 255, 0)">Đã duyệt</label>
                    @elseif($item->status == 2)
                        <label style="background-color: rgb(255, 55, 0)">Từ chối</label>
                    @endif
                </x-lf.table.item>
                <x-lf.table.item name="created_at" :fields="$fields">{{ $item->created_at }}</x-lf.table.item>
                {{-- <x-lf.table.item name="updated_at" :fields="$fields">{{ $item->updated_at }}</x-lf.table.item> --}}

                <td class="action">
                    @can('time-keep.singles.show')
                        <a class="btn-success xs"
                            href="{{ route('time-keep.singles.show', $item->id) }}">{!! lfIcon('launch', 10) !!}</a>
                    @endcan
                    @can('time-keep.singles.edit')
                        <a class="btn-info xs"
                            href="{{ route('time-keep.singles.edit', $item->id) }}">{!! lfIcon('edit', 10) !!}</a>
                    @endcan
                    @can('time-keep.singles.delete')
                        <x-lf.btn.delete :record="$item->id" :confirm="$confirm" />
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    <x-slot name="filters">
        <x-lf.filter.input name="fId" type="number" placeholder="Id ..." />
    </x-slot>
    <x-slot name="tools">
        @can('time-keep.singles.create')
            <div> <a class="btn-primary sm" href="{{ route('time-keep.singles.create') }}">{!! lfIcon('add') !!}</a>
            </div>
        @endcan
    </x-slot>
</x-lf.page.listing>
