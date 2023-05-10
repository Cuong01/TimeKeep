<div style="padding: 10px">
    <x-lf.card>
        <div style="width:100%;padding:20px">
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
        <div style="padding: 20px;width: 100%">
            <div style="width: 100%;background-color: white; ">

                @if (!empty($messages))
                    <div
                        style="width: 100%;height: 50px; text-align: center; font-size: 16px; background-color: rgba(240, 58, 34, 0.5);line-height: 50px">
                        <label>
                            {{ $messages }} Vui lòng <a href="{{ route('time-keep.timekeep-rules') }}"
                                style="color: #0050fc;text-decoration: underline">chọn luật</a> hoặc <a
                                href="{{ route('time-keep.timekeep-rules.create') }}"
                                style="color: #0050fc;text-decoration: underline">thêm mới</a>.
                        </label>
                    </div>
                @endif
                <div class="contener">
                    <b>Bảng chấm công tháng {{ $month }} của nhân viên <span
                            style="color: red; font-size: 25px;">{{ $data->name }}</span> </b>
                </div>
                <table>
                    <tr style="background-color:rgb(222, 222, 222)">
                        {{-- <th class="same">Tên nhân viên</th> --}}
                        <th class="same">Thứ</th>
                        <th class="same">Ngày</th>
                        <th class="same">Giờ vào</th>
                        <th class="same">Giờ ra</th>
                        <th class="same">Số công</th>
                        <th class="same">Phạt đi muộn (VNĐ)</th>
                        <th class="same">Phạt về sớm (VNĐ)</th>
                        <th class="same">Đơn (đã duyệt)</th>
                    </tr>
                    @foreach ($staffs['timekeep'] as $staff)
                        @if (!empty($staff['holiday']))
                            <tr style="background-color: rgb(228, 255, 197)">
                                <td>{{ $staff['day_text'] }}</td>
                                <td>{{ $staff['day'] }}</td>
                                <td>{{ $staff['created_at'] }}</td>
                                <td>{{ $staff['updated_at'] }}</td>
                                <td style="color: red;">{{ $staff['cong'] }} </td>
                                <td>{{ $staff['sum_money_late'] }}</td>
                                <td>{{ $staff['sum_money_soon'] }}</td>
                                @if (!empty($staff['single_id']))
                                    <td>
                                        <a
                                            href="{{ route('time-keep.singles.show', $staff['single_id']) }}">{{ $staff['single'] }}</a>
                                    </td>
                                @else
                                    <td>{{ $staff['single'] }}</td>
                                @endif
                            </tr>
                        @elseif ($staff['day_text'] == 'CN')
                            <tr style="background-color: rgb(250, 204, 164)">
                                <td>{{ $staff['day_text'] }}</td>
                                <td>{{ $staff['day'] }}</td>
                                <td>{{ $staff['created_at'] }}</td>
                                <td>{{ $staff['updated_at'] }}</td>
                                <td style="color: red;">{{ $staff['cong'] }} </td>
                                <td>{{ $staff['sum_money_late'] }}</td>
                                <td>{{ $staff['sum_money_soon'] }}</td>
                                @if (!empty($staff['single_id']))
                                    <td>
                                        <a
                                            href="{{ route('time-keep.singles.show', $staff['single_id']) }}">{{ $staff['single'] }}</a>
                                    </td>
                                @else
                                    <td>{{ $staff['single'] }}</td>
                                @endif
                            </tr>
                        @elseif($staff['day_text'] == 'T7')
                            <tr style="background-color: rgb(250, 255, 162)">
                                <td>{{ $staff['day_text'] }}</td>
                                <td>{{ $staff['day'] }}</td>
                                <td>{{ $staff['created_at'] }}</td>
                                <td>{{ $staff['updated_at'] }}</td>
                                <td style="color: red;">{{ $staff['cong'] }} </td>
                                <td>{{ $staff['sum_money_late'] }}</td>
                                <td>{{ $staff['sum_money_soon'] }}</td>
                                @if (!empty($staff['single_id']))
                                    <td>
                                        <a
                                            href="{{ route('time-keep.singles.show', $staff['single_id']) }}">{{ $staff['single'] }}</a>
                                    </td>
                                @else
                                    <td>{{ $staff['single'] }}</td>
                                @endif
                            </tr>
                        @else
                            <tr>
                                <td>{{ $staff['day_text'] }}</td>
                                <td>{{ $staff['day'] }}</td>
                                <td>{{ $staff['created_at'] }}</td>
                                <td>{{ $staff['updated_at'] }}</td>
                                <td style="color: red;">{{ $staff['cong'] }} </td>
                                <td>{{ $staff['sum_money_late'] }}</td>
                                <td>{{ $staff['sum_money_soon'] }}</td>
                                @if (!empty($staff['single_id']))
                                    <td>
                                        <a
                                            href="{{ route('time-keep.singles.show', $staff['single_id']) }}">{{ $staff['single'] }}</a>
                                    </td>
                                @else
                                    <td>{{ $staff['single'] }}</td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="4">
                            Tổng:
                        </td>

                        <td>
                            {{ $staffs['tong'] }} công
                        </td>
                        <td> {{ $staffs['sum_late'] }}
                            VNĐ
                        </td>
                        <td> {{ $staffs['sum_soon'] }}
                            VNĐ
                        </td>

                    </tr>
                    <tr>
                        <td colspan="5">
                            <p>
                                <b>Tổng công: </b> <span
                                    style="color: red; font-size: 17px;">{{ $staffs['tong'] }}</span>
                                công
                            <p>
                        </td>
                        <td colspan="3">
                            <p>
                                <b>Tổng tiền phạt: </b> <span
                                    style="color: red; font-size: 17px;">{{ $staffs['tongphat'] }}</span>
                                VNĐ
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </x-lf.card>
</div>

<style>
    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    .contener {
        width: 100%;
        font-size: 22px;
        text-align: center;
        padding: 20px;
    }

    table {
        width: 100%;
        border: 1px solid rgb(166, 166, 166);
        font-size: 16px;
    }

    tr,
    th,
    td {
        border: 1px solid rgb(166, 166, 166);
        padding: 5px;
        text-align: center;
    }
</style>
