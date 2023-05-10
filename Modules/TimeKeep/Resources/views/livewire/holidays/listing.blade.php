<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
                </th>
                <x-lf.table.label name="name" :fields="$fields">Tên ngày lễ</x-lf.table.label>
                <x-lf.table.label name="from_day" :fields="$fields">Nghỉ từ ngày</x-lf.table.label>
                <x-lf.table.label name="to_day" :fields="$fields">Đến ngày</x-lf.table.label>
                <x-lf.table.label name="salary_half" :fields="$fields">Phần trăm lương nghỉ lễ (%)
                </x-lf.table.label>
                <x-lf.table.label name="salary_working" :fields="$fields">Phần trăm lương đi làm ngày lễ (%)
                </x-lf.table.label>
                <x-lf.table.label name="status" :fields="$fields">Trạng thái</x-lf.table.label>
                <th></th>
            </tr>
        </thead>
        @foreach ($data as $item)
            <tr>
                <th class="stt">{{ $item->id }}</th>
                <x-lf.table.item name="name" :fields="$fields">{{ $item->name }}</x-lf.table.item>
                <x-lf.table.item name="from_day" :fields="$fields">{{ $item->from_day }}</x-lf.table.item>
                <x-lf.table.item name="to_day" :fields="$fields">{{ $item->to_day }}</x-lf.table.item>
                <x-lf.table.item name="salary_half" :fields="$fields">{{ $item->salary_half }}</x-lf.table.item>
                <x-lf.table.item name="salary_working" :fields="$fields">{{ $item->salary_working }}</x-lf.table.item>
                <x-lf.table.item name="status" :fields="$fields">
                    <x-lf.btn.toggle :val="$item->status" wire:change="changeStatus({{ $item->id }})" />
                </x-lf.table.item>

                <td class="action">
                    @can('time-keep.holidays.show')
                        <a class="btn-success xs"
                            href="{{ route('time-keep.holidays.show', $item->id) }}">{!! lfIcon('launch', 10) !!}</a>
                    @endcan
                    @can('time-keep.holidays.edit')
                        <a class="btn-info xs"
                            href="{{ route('time-keep.holidays.edit', $item->id) }}">{!! lfIcon('edit', 10) !!}</a>
                    @endcan
                    @can('time-keep.holidays.delete')
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
        @can('time-keep.holidays.create')
            <div> <a class="btn-primary sm" href="{{ route('time-keep.holidays.create') }}">{!! lfIcon('add') !!}</a>
            </div>
        @endcan
    </x-slot>
</x-lf.page.listing>
