<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
                </th>
                <x-lf.table.label name="user_id" :fields="$fields">Tên</x-lf.table.label>
                <x-lf.table.label name="place_of_birth" :fields="$fields">Giới tính</x-lf.table.label>
                <x-lf.table.label name="home_town" :fields="$fields">Công ty</x-lf.table.label>
                <x-lf.table.label name="ethnic" :fields="$fields">Phòng ban</x-lf.table.label>
                <x-lf.table.label name="religion" :fields="$fields">Chức vụ</x-lf.table.label>
                <x-lf.table.label name="religion" :fields="$fields">Luật chấm công</x-lf.table.label>
                <x-lf.table.label name="sign_day" :fields="$fields">Ngày bắt đầu HĐ</x-lf.table.label>
                <x-lf.table.label name="expiration_date" :fields="$fields">Ngày kết thúc HĐ</x-lf.table.label>
                <x-lf.table.label name="expiration_date" :fields="$fields">Trạng thái HĐ</x-lf.table.label>
                {{-- <x-lf.table.label name="created_at" :fields="$fields">Created At</x-lf.table.label>
                <x-lf.table.label name="updated_at" :fields="$fields">Updated At</x-lf.table.label> --}}

                <th></th>
            </tr>
        </thead>
        @foreach ($data as $item)
        <tr>
            <th class="stt">{{ $item->id }}</th>
            <x-lf.table.item name="user_id" :fields="$fields">
                {{ $item->name }}

            </x-lf.table.item>
            <x-lf.table.item name="ethnic" :fields="$fields">
                @if ($item->gender == 0)
                Nam
                @elseif($item->gender == 1)
                Nữ
                @elseif($item->gender == 2)
                Khác
                @endif
            </x-lf.table.item>

            <x-lf.table.item name="ethnic" :fields="$fields">
                @foreach ($companies as $com)
                @if ($item->company_id == $com->id)
                {{ $com->name }}
                @endif
                @endforeach
                @if ($item->company_id == 0)
                @endif
            </x-lf.table.item>
            <x-lf.table.item name="ethnic" :fields="$fields">
                @foreach ($departments as $dep)
                @if ($item->department_id == $dep->id)
                {{ $dep->name }}
                @endif
                @endforeach
                @if ($item->department_id == 0)
                @endif
            </x-lf.table.item>

            <x-lf.table.item name="ethnic" :fields="$fields">
                @foreach ($positions as $pos)
                @if ($item->position_id == $pos->id)
                {{ $pos->name }}
                @endif
                @endforeach
                @if ($item->position_id == 0)
                @endif
            </x-lf.table.item>
            <x-lf.table.item name="ethnic" :fields="$fields">
                @if (!empty($item->timekeep_rule))
                @foreach ($timekeepRules as $rule)
                @if ($rule->id == $item->timekeep_rule)
                {{ $rule->name }}
                @endif
                @endforeach
                @else
                Chưa có luật
                @endif
            </x-lf.table.item>
            <x-lf.table.item name="sign_day" :fields="$fields">{{ $item->sign_day }}</x-lf.table.item>
            <x-lf.table.item name="expiration_date" :fields="$fields">{{ $item->expiration_date }}
            </x-lf.table.item>
            <x-lf.table.item name="created_at" :fields="$fields">
                @if (strtotime($item->expiration_date) <= $day) <a style="color:red">Hết hiệu lực</a>
                    @else
                    <a>Còn hiệu lực</a>
                    @endif
            </x-lf.table.item>
            {{-- <x-lf.table.item name="created_at" :fields="$fields">{{ $item->created_at }}</x-lf.table.item>
            <x-lf.table.item name="updated_at" :fields="$fields">{{ $item->updated_at }}</x-lf.table.item> --}}

            <td class="action">
                @can('company.staff-infomations.show')
                <a class="btn-success xs" href="{{ route('company.staff-infomations.show', $item->id) }}">{!! lfIcon('launch', 10) !!}</a>
                @endcan
                @can('company.staff-infomations.edit')
                <a class="btn-info xs" href="{{ route('company.staff-infomations.edit', $item->id) }}">{!! lfIcon('edit', 10) !!}</a>
                @endcan
                @can('company.staff-infomations.delete')
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
        @can('company.staff-infomations.create')
        <div> <a class="btn-primary sm" href="{{ route('company.staff-infomations.create') }}">{!! lfIcon('add') !!}</a></div>
        @endcan
    </x-slot>
</x-lf.page.listing>