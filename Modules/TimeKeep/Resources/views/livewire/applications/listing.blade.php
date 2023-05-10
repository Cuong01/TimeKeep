<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
                </th>
                <x-lf.table.label name="name" :fields="$fields">Tên loại nghỉ</x-lf.table.label>
                <x-lf.table.label name="salary" :fields="$fields">Lương được hưởng (%)</x-lf.table.label>
                <x-lf.table.label name="day" :fields="$fields">Số ngày nghỉ tối đa (ngày)</x-lf.table.label>
                <x-lf.table.label name="status" :fields="$fields">Trạng thái</x-lf.table.label>
                {{-- <x-lf.table.label name="created_at" :fields="$fields">Created At</x-lf.table.label>
                <x-lf.table.label name="updated_at" :fields="$fields">Updated At</x-lf.table.label> --}}

                <th></th>
            </tr>
        </thead>
        @foreach ($data as $item)
            <tr>
                <th class="stt">{{ $item->id }}</th>
                <x-lf.table.item name="name" :fields="$fields">{{ $item->name }}</x-lf.table.item>
                <x-lf.table.item name="salary" :fields="$fields">{{ $item->salary }}</x-lf.table.item>
                <x-lf.table.item name="day" :fields="$fields">{{ $item->day }}</x-lf.table.item>
                {{-- <x-lf.table.item name="status" :fields="$fields">{{$item->status}}</x-lf.table.item> --}}
                <x-lf.table.item name="status" :fields="$fields">
                    <x-lf.btn.toggle :val="$item->status" wire:change="changeStatus({{ $item->id }})" />
                </x-lf.table.item>
                {{-- <x-lf.table.item name="created_at" :fields="$fields">{{ $item->created_at }}</x-lf.table.item>
                <x-lf.table.item name="updated_at" :fields="$fields">{{ $item->updated_at }}</x-lf.table.item> --}}

                <td class="action">
                    @can('time-keep.applications.show')
                        <a class="btn-success xs"
                            href="{{ route('time-keep.applications.show', $item->id) }}">{!! lfIcon('launch', 10) !!}</a>
                    @endcan
                    @can('time-keep.applications.edit')
                        <a class="btn-info xs"
                            href="{{ route('time-keep.applications.edit', $item->id) }}">{!! lfIcon('edit', 10) !!}</a>
                    @endcan
                    @can('time-keep.applications.delete')
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
        @can('time-keep.applications.create')
            <div> <a class="btn-primary sm" href="{{ route('time-keep.applications.create') }}">{!! lfIcon('add') !!}</a>
            </div>
        @endcan
    </x-slot>
</x-lf.page.listing>
