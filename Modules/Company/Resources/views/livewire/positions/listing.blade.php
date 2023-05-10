<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
                </th>
                <x-lf.table.label name="name" :fields="$fields">Tên cấp bậc</x-lf.table.label>
                <x-lf.table.label name="company_id" :fields="$fields">Công ty</x-lf.table.label>
                <x-lf.table.label name="level" :fields="$fields">Mức độ</x-lf.table.label>
                <x-lf.table.label name="created_at" :fields="$fields">Thời gian thêm</x-lf.table.label>
                <x-lf.table.label name="updated_at" :fields="$fields">Thời gian sửa</x-lf.table.label>

                <th></th>
            </tr>
        </thead>
        @foreach ($data as $item)
            <tr>
                <th class="stt">{{ $item->id }}</th>
                <x-lf.table.item name="name" :fields="$fields">{{ $item->name }}</x-lf.table.item>
                @foreach ($companies as $com)
                    @if ($item->company_id == $com->id)
                        <x-lf.table.item name="company_id" :fields="$fields">{{ $com->name }}</x-lf.table.item>
                    @endif
                @endforeach
                <x-lf.table.item name="level" :fields="$fields">{{ $item->level }}</x-lf.table.item>
                <x-lf.table.item name="created_at" :fields="$fields">{{ $item->created_at }}</x-lf.table.item>
                <x-lf.table.item name="updated_at" :fields="$fields">{{ $item->updated_at }}</x-lf.table.item>

                <td class="action">
                    @can('company.positions.show')
                        <a class="btn-success xs"
                            href="{{ route('company.positions.show', $item->id) }}">{!! lfIcon('launch', 10) !!}</a>
                    @endcan
                    @can('company.positions.edit')
                        <a class="btn-info xs"
                            href="{{ route('company.positions.edit', $item->id) }}">{!! lfIcon('edit', 10) !!}</a>
                    @endcan
                    @can('company.positions.delete')
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
        @can('company.positions.create')
            <div> <a class="btn-primary sm" href="{{ route('company.positions.create') }}">{!! lfIcon('add') !!}</a></div>
        @endcan
    </x-slot>
</x-lf.page.listing>
