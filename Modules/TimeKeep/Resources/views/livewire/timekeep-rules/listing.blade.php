<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
                </th>
                <x-lf.table.label name="name" :fields="$fields">Tên</x-lf.table.label>
                <x-lf.table.label name="name" :fields="$fields">Loại chấm công</x-lf.table.label>
                {{-- <x-lf.table.label name="value" :fields="$fields">Value</x-lf.table.label> --}}
                <x-lf.table.label name="status" :fields="$fields">Trạng thái</x-lf.table.label>
                <x-lf.table.label name="status" :fields="$fields">Đặt làm mặc định</x-lf.table.label>
                <x-lf.table.label name="created_at" :fields="$fields">Thời gian thêm</x-lf.table.label>
                <x-lf.table.label name="updated_at" :fields="$fields">Thời gian sửa</x-lf.table.label>

                <th></th>
            </tr>
        </thead>
        @foreach ($data as $item)
            <tr>
                <th class="stt">{{ $item->id }}</th>
                <x-lf.table.item name="name" :fields="$fields">{{ $item->name }}</x-lf.table.item>
                <x-lf.table.item name="name" :fields="$fields">
                    @if ($item->type == 0)
                        Chấm công theo ngày
                    @else
                        Chấm công theo ca
                    @endif
                </x-lf.table.item>
                {{-- <x-lf.table.item name="value" :fields="$fields">{{$item->value}}</x-lf.table.item> --}}
                <x-lf.table.item name="status" :fields="$fields">
                    <x-lf.btn.toggle :val="$item->status" wire:change="changeStatus({{ $item->id }})" />
                </x-lf.table.item>
                <x-lf.table.item name="status" :fields="$fields">
                    <x-lf.btn.toggle :val="$item->active" wire:change="changeActive({{ $item->id }})" />
                </x-lf.table.item>
                <x-lf.table.item name="created_at" :fields="$fields">{{ date_format($item->created_at, 'Y:m:d') }}
                </x-lf.table.item>
                <x-lf.table.item name="updated_at" :fields="$fields">{{ date_format($item->updated_at, 'Y:m:d') }}
                </x-lf.table.item>

                <td class="action">
                    @can('time-keep.timekeep-rules.show')
                        <a class="btn-success xs"
                            href="{{ route('time-keep.timekeep-rules.show', $item->id) }}">{!! lfIcon('launch', 10) !!}</a>
                    @endcan
                    @can('time-keep.timekeep-rules.edit')
                        <a class="btn-info xs"
                            href="{{ route('time-keep.timekeep-rules.edit', $item->id) }}">{!! lfIcon('edit', 10) !!}</a>
                    @endcan
                    @can('time-keep.timekeep-rules.delete')
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
        @can('time-keep.timekeep-rules.create')
            <div> <a class="btn-primary sm"
                    href="{{ route('time-keep.timekeep-rules.create') }}">{!! lfIcon('add') !!}</a></div>
        @endcan
    </x-slot>
</x-lf.page.listing>
