<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
                </th>
                <x-lf.table.label name="name" :fields="$fields">Tên nhân viên</x-lf.table.label>
                <x-lf.table.label name="email" :fields="$fields">Email</x-lf.table.label>
                <x-lf.table.label name="profile_photo_path" :fields="$fields">Ảnh</x-lf.table.label>
                <x-lf.table.label name="is_admin" :fields="$fields">Is Admin</x-lf.table.label>
                <x-lf.table.label name="gender" :fields="$fields">Giới tính</x-lf.table.label>
                <x-lf.table.label name="company_id" :fields="$fields">Công ty</x-lf.table.label>
                <x-lf.table.label name="department_id" :fields="$fields">Phòng ban</x-lf.table.label>
                <x-lf.table.label name="position_id" :fields="$fields">Chức vụ</x-lf.table.label>
                <x-lf.table.label name="level" :fields="$fields">Luật chấm công</x-lf.table.label>
                <x-lf.table.label name="address" :fields="$fields">Ngày bắt đầu HĐ</x-lf.table.label>
                <x-lf.table.label name="phone" :fields="$fields">Ngày kết thúc HĐ</x-lf.table.label>
                {{-- <x-lf.table.label name="phone" :fields="$fields">Trạng thái HĐ</x-lf.table.label> --}}
                <th></th>
            </tr>
        </thead>
        @foreach ($data as $item)
            <tr>
                <th class="stt">{{ $item->id }}</th>

                <x-lf.table.item name="name" :fields="$fields">
                    <a style="color: blue" href="{{ route('company.staff-infomations.create') }}">{{ $item->name }}
                    </a>
                </x-lf.table.item>

                <x-lf.table.item name="email" :fields="$fields">{{ $item->email }}</x-lf.table.item>
                {{-- <x-lf.table.item name="current_team_id" :fields="$fields">{{$item->current_team_id}}</x-lf.table.item> --}}
                <x-lf.table.item name="profile_photo_path" :fields="$fields">
                    @if ($item->profile_photo_path)
                        <img src="/{{ json_decode($item->profile_photo_path)->name }}" width="100px" height="100px">
                    @else
                        <img src="{{ $item->profile_photo_url }}" width="100px" height="100px">
                    @endif
                </x-lf.table.item>
                <x-lf.table.item name="is_admin" :fields="$fields">
                    <x-lf.btn.toggle :val="$item->is_admin" wire:change="changeIsAdmin({{ $item->id }})" />
                </x-lf.table.item>

                <x-lf.table.item name="gender" :fields="$fields">
                    @if ($item->gender == 0)
                        Nam
                    @elseif($item->gender == 1)
                        Nữ
                    @elseif($item->gender == 2)
                        Khác
                    @endif
                </x-lf.table.item>

                <x-lf.table.item name="company_id" :fields="$fields">
                    @foreach ($companies as $com)
                        @if ($item->company_id == $com->id)
                            {{ $com->name }}
                        @endif
                    @endforeach
                    @if ($item->company_id == 0)
                        0
                    @endif
                </x-lf.table.item>
                <x-lf.table.item name="level" :fields="$fields">
                    @foreach ($departments as $dep)
                        @if ($item->department_id == $dep->id)
                            {{ $dep->name }}
                        @endif
                    @endforeach
                    @if ($item->department_id == 0)
                        0
                    @endif
                </x-lf.table.item>

                <x-lf.table.item name="other_info" :fields="$fields">
                    @foreach ($positions as $pos)
                        @if ($item->position_id == $pos->id)
                            {{ $pos->name }}
                        @endif
                    @endforeach
                    @if ($item->position_id == 0)
                        0
                    @endif
                </x-lf.table.item>
                <x-lf.table.item name="phone" :fields="$fields">
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


                <x-lf.table.item name="phone" :fields="$fields">
                    @foreach ($profiles as $profile)
                        @if ($profile->user_id == $item->id)
                            {{ date_format(date_create($profile->sign_day), 'd-m-Y') }}
                        @endif
                    @endforeach
                </x-lf.table.item>

                <x-lf.table.item name="phone" :fields="$fields">
                    @foreach ($profiles as $profile)
                        @if ($profile->user_id == $item->id)
                            {{ date_format(date_create($profile->expiration_date), 'd-m-Y') }}
                        @endif
                    @endforeach
                </x-lf.table.item>



                <td class="action">
                    @can('company.users.show')
                        <a class="btn-success xs"
                            href="{{ route('company.users.show', $item->id) }}">{!! lfIcon('launch', 10) !!}</a>
                    @endcan
                    @can('company.users.edit')
                        <a class="btn-info xs"
                            href="{{ route('company.users.edit', $item->id) }}">{!! lfIcon('edit', 10) !!}</a>
                    @endcan
                    @can('company.users.delete')
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
        @can('company.users.create')
            <div> <a class="btn-primary sm" href="{{ route('company.users.create') }}">{!! lfIcon('add') !!}</a></div>
        @endcan
    </x-slot>
</x-lf.page.listing>
