@if (session()->has('error'))
    {{ session()->get('error') }}
@else
    <x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
        @if (!empty($messages))
            <label
                style="width: 100%;height: 50px; text-align: center; font-size: 16px; background-color: rgba(240, 58, 34, 0.5);line-height: 50px">
                {{ $messages }} Vui lòng <a href="{{ route('time-keep.timekeep-rules') }}"
                    style="color: #0050fc;text-decoration: underline">chọn luật</a> hoặc <a
                    href="{{ route('time-keep.timekeep-rules.create') }}"
                    style="color: #0050fc;text-decoration: underline">thêm mới</a>.
            </label>
        @endif

        <div wire:poll.100s style="padding: 5%">
            {{ QrCode::size(200)->generate('http://192.168.1.18:8012/time-keep/timekeeps/chamcong/' . $time) }}
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>
                        <x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort>
                    </th>
                    <x-lf.table.label name="user_id" :fields="$fields">Tên nhân viên</x-lf.table.label>
                    <x-lf.table.label name="time" :fields="$fields">Ngày</x-lf.table.label>
                    <x-lf.table.label name="note" :fields="$fields">IP</x-lf.table.label>
                    <x-lf.table.label name="created_at" :fields="$fields">Nhận ca</x-lf.table.label>
                    <x-lf.table.label name="updated_at" :fields="$fields">Chốt ca</x-lf.table.label>

                    <th></th>
                </tr>
            </thead>
            @foreach ($data as $item)
                <tr>
                    <th class="stt">{{ $item->id }}</th>
                    <x-lf.table.item name="user_id" :fields="$fields">
                        @foreach ($user as $k => $us)
                            @if ($us->id == $item->user_id)
                                {{ $us->name }}
                            @endif
                        @endforeach
                    </x-lf.table.item>
                    <x-lf.table.item name="time" :fields="$fields">{{ $item->time }}</x-lf.table.item>
                    <x-lf.table.item name="note" :fields="$fields">{{ $item->note }}</x-lf.table.item>
                    <x-lf.table.item name="created_at" :fields="$fields">{{ $item->created_at }}</x-lf.table.item>
                    <x-lf.table.item name="updated_at" :fields="$fields">{{ $item->updated_at }}</x-lf.table.item>

                    <td class="action">
                        @can('time-keep.timekeeps.delete')
                            <x-lf.btn.delete :record="$item->id" :confirm="$confirm" />
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>
        <label style="margin: 10px" class="btn-primary" wire:click="store">Chấm công</label>

        <div style="width:100%;padding:10px">
            <select name="month_date" wire:model="month_date">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">Tháng {{ $i }}</option>
                @endfor
            </select>
            <select name="years_date" wire:model="years_date" style="margin:10px; width: 100px;">
                @for ($i = 2000; $i <= 2050; $i++)
                    <option value="{{ $i }}"> {{ $i }}</option>
                @endfor
            </select>
        </div>

        <table style="margin-top: 50px; width:100%">
            <tr style="background-color:rgb(222, 222, 222); text-align: center;">
                <th style="padding: 10px;">Tên NV\Ngày</th>
                @foreach ($days as $day)
                    @if (!empty($day['holiday']))
                        <th style=" background-color: rgb(228, 255, 197);padding: 10px ">
                            <p>{{ $day['day'] }}</p>
                        </th>
                    @elseif ($day['day_text'] == 'CN')
                        <th style=" background-color: rgb(250, 204, 164);padding: 10px ">
                            <p>{{ $day['day'] }}</p>
                        </th>
                    @elseif($day['day_text'] == 'T7')
                        <th style=" background-color: rgb(250, 255, 162);padding: 10px">
                            <p>{{ $day['day'] }}</p>
                        </th>
                    @else
                        <th style="padding: 10px; ">
                            <p>{{ $day['day'] }}</p>
                        </th>
                    @endif
                @endforeach
                <th style="padding: 10px;">Tổng số</th>
            </tr>
            @if (!empty($staffs))
                @foreach ($staffs as $id => $staff)
                    <tr>
                        <td style="padding: 10px;">
                            <a href="{{ route('time-keep.timekeeps.show', $staff['user_id']) }}" style="color: blue">
                                <input type="button" value="{{ $staff['name'] }}">
                            </a>
                        </td>

                        @foreach ($staff['timekeep'] as $key => $cong)
                            @if (!empty($cong['holiday']))
                                <td style="background-color: rgb(228, 255, 197);padding: 10px; text-align: center; ">
                                    <p>{{ $cong['cong'] }}</p>

                                </td>
                            @elseif ($cong['day_text'] == 'CN')
                                <td style="background-color: rgb(250, 204, 164);padding: 10px; text-align: center; ">
                                    <p>{{ $cong['cong'] }}</p>

                                </td>
                            @elseif($cong['day_text'] == 'T7')
                                <td style="background-color: rgb(250, 255, 162);padding: 10px; text-align: center;">
                                    <p>{{ $cong['cong'] }}</p>

                                </td>
                            @else
                                <td style="padding: 10px;  text-align: center;">
                                    <p>{{ $cong['cong'] }}</p>
                            @endif
                        @endforeach
                        <td style="padding: 10px;  text-align: center;">
                            {{ $staff['tong'] }}
                        </td>

                    </tr>
                @endforeach
            @endif
        </table>
    </x-lf.page.listing>
@endif
