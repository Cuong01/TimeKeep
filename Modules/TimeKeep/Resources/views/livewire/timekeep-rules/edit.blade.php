<div class="w-full p-1 md:p-4">
    <x-lf.card title="Cập nhật" class="warning">
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            / Firefox / input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
        <div style="display: flex; width: 100%">
            <x-lf.form.input name="name" type="string" onClick="this.select();" style="padding-left:10px">
                <x-slot:label>
                    <span>Tên luật chấm công <span class="text-red-500">(*)</span></span>
                </x-slot:label>
            </x-lf.form.input>
            <x-lf.form.select name="type" label="Loại tính công" :default="['----Chon loại tính công----']" :params="[0 => 'Tính công theo ngày', 1 => 'Tính công theo ca']"
                style="padding-left:10px" disabled />
        </div>
        {{-- <x-lf.form.input name="status" type="integer" label="Status" placeholder="Status ..."/> --}}
        @if ($type == 0)
            <div style="display: flex; width:100%; padding-top:20px">
                <div style="width:50%; border-right: 1px solid #DDD">
                    <div style="padding: 10px">
                        <label style="padding-top: 7px; font-size: 18px;font-weight: bold; ">Thiết lập ca sáng:
                            <span style="color: #999">(Tổng thời gian {{ $sum_time_mor }})</span></label>
                        <div style="display: flex; border-bottom:1px solid #DDD;  padding-bottom: 10px">
                            <x-lf.form.input name="input_time_mor" type="time">
                                <x-slot:label>
                                    <span>Giờ bắt đầu ca <span class="text-red-500">(*)</span></span>
                                </x-slot:label>
                            </x-lf.form.input>
                            <x-lf.form.input name="output_time_mor" type="time">
                                <x-slot:label>
                                    <span>Giờ kết thúc ca <span class="text-red-500">(*)</span></span>
                                </x-slot:label>
                            </x-lf.form.input>
                            <x-lf.form.input name="count_mor" type="number" onClick="this.select();"
                                placeholder="VD: 0.25, 0.5,...">
                                <x-slot:label>
                                    <span>Số công <span class="text-red-500">(*)</span></span>
                                </x-slot:label>
                            </x-lf.form.input>
                        </div>
                        <div style="padding: 20px 0; border-bottom:1px solid #DDD">
                            <b style="padding-top: 7px ; font-size: 16px">Luật tính công khi đi muộn</b>
                            @if (!empty($input_time_mor) || !empty($output_time_mor))
                                <p style="padding-top: 5px;color:rgb(255, 0, 0);font-size: 13px">Thời gian nhập
                                    trong khoảng từ
                                    {{ $input_time_mor }} đến
                                    {{ $output_time_mor }}</p>
                            @endif
                            @foreach ($option_after_mors as $key => $option_after_mor)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex; padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input name="option_after_mors.{{ $key }}.time_after"
                                            type="time" label="Đến sau thời gian" style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>
                                        <x-lf.form.input type="number"
                                            name="option_after_mors.{{ $key }}.count_after" label="Số công"
                                            style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 0.25, 0.5,..." />
                                    </div>
                                    <div>
                                        @if (count($option_after_mors) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionAfterMor({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionDayAfterMor">Thêm
                                mới</button>
                        </div>

                        <div style="padding: 20px 0; border-bottom:1px solid #DDD">
                            <b style="padding-top: 7px ; font-size: 16px">Luật tính công khi về sớm</b>
                            @if (!empty($input_time_mor) || !empty($output_time_mor))
                                <p style="padding-top: 5px;color:rgb(255, 0, 0);font-size: 13px">Thời gian nhập
                                    trong khoảng từ
                                    {{ $input_time_mor }} đến
                                    {{ $output_time_mor }}</p>
                            @endif
                            @foreach ($option_before_mors as $key => $option_before_mor)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex;padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input name="option_before_mors.{{ $key }}.time_before"
                                            type="time" label="Về trước thời gian" style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>
                                        <x-lf.form.input type="number"
                                            name="option_before_mors.{{ $key }}.count_before" label="Số công"
                                            style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 0.25, 0.5,..." />

                                    </div>
                                    <div>
                                        @if (count($option_before_mors) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionDayBeforeMor({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionDayBeforeMor">Thêm
                                mới</button>
                        </div>

                        <div style="padding: 20px 0;">
                            <b style="padding-top: 7px; font-size: 16px">Luật phạt tiền khi đi muộn</b>

                            @foreach ($option_penance_lates as $key => $option_penance_late)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex;padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input
                                            name="option_penance_lates.{{ $key }}.time_penance_late"
                                            type="number" label="Đi muộn với số phút " style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>
                                        <x-lf.form.input type="text"
                                            name="option_penance_lates.{{ $key }}.monney_penance_late"
                                            label="Tiền phạt (VNĐ)" style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 10.000" />
                                    </div>
                                    <div>
                                        @if (count($option_penance_lates) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionPenanceLate({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionPenanceLate">Thêm
                                mới</button>
                        </div>

                    </div>
                </div>

                <div style="width:50%;">
                    <div style="padding: 10px">
                        <label style="padding-top: 7px; font-size: 18px;font-weight: bold; ">Thiết lập ca
                            chiều:
                            <span style="color: #999">(Tổng thời gian {{ $sum_time_aft }})</span></label>

                        <div style="display: flex; border-bottom:1px solid #DDD; padding-bottom: 10px ">
                            <x-lf.form.input name="input_time_aft" type="time">
                                <x-slot:label>
                                    <span>Giờ bắt đầu ca <span class="text-red-500">(*)</span></span>
                                </x-slot:label>
                            </x-lf.form.input>
                            <x-lf.form.input name="output_time_aft" type="time">
                                <x-slot:label>
                                    <span>Giờ kết thúc ca <span class="text-red-500">(*)</span></span>
                                </x-slot:label>
                            </x-lf.form.input>
                            <x-lf.form.input name="count_aft" type="number" onClick="this.select();"
                                placeholder="VD: 0.25, 0.5,...">
                                <x-slot:label>
                                    <span>Số công <span class="text-red-500">(*)</span></span>
                                </x-slot:label>
                            </x-lf.form.input>
                        </div>

                        <div style="padding: 20px 0; border-bottom:1px solid #DDD">
                            <b style="padding-top: 7px ; font-size: 16px">Luật tính công khi đi muộn</b>
                            @if (!empty($input_time_aft) || !empty($output_time_aft))
                                <p style="padding-top: 5px;color:rgb(255, 0, 0);font-size: 13px">Thời gian nhập
                                    trong khoảng
                                    từ
                                    {{ $input_time_aft }} đến
                                    {{ $output_time_aft }}</p>
                            @endif
                            @foreach ($option_after_afts as $key => $option_after_aft)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex;padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input name="option_after_afts.{{ $key }}.time_after"
                                            type="time" label="Đến sau thời gian" style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>
                                        <x-lf.form.input type="number"
                                            name="option_after_afts.{{ $key }}.count_after" label="Số công"
                                            style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 0.25, 0.5,..." />
                                    </div>
                                    <div>
                                        @if (count($option_after_afts) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionAfterAft({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionDayAfterAft">Thêm
                                mới</button>
                        </div>

                        <div style="padding: 20px 0; border-bottom:1px solid #DDD">
                            <b style="padding-top: 7px ; font-size: 16px">Luật tính công khi về sớm</b>
                            @if (!empty($input_time_aft) || !empty($output_time_aft))
                                <p style="padding-top: 5px;color:rgb(255, 0, 0);font-size: 13px">Thời gian nhập
                                    trong khoảng
                                    từ
                                    {{ $input_time_aft }} đến
                                    {{ $output_time_aft }}</p>
                            @endif
                            @foreach ($option_before_afts as $key => $option_before_aft)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex;padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input name="option_before_afts.{{ $key }}.time_before"
                                            type="time" label="Về trước thời gian" style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>
                                        <x-lf.form.input type="number"
                                            name="option_before_afts.{{ $key }}.count_before"
                                            label="Số công" style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 0.25, 0.5,..." />
                                    </div>
                                    <div>
                                        @if (count($option_before_afts) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionDayBeforeAft({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionDayBeforeAft">Thêm
                                mới</button>
                        </div>

                        <div style=" padding: 20px 0">
                            <b style="padding-top: 7px; font-size: 16px">Luật phạt tiền khi về sớm</b>

                            @foreach ($option_penance_soons as $key => $option_penance_soon)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex;padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input
                                            name="option_penance_soons.{{ $key }}.time_penance_soon"
                                            type="number" label="Về sớm với số phút" style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>
                                        <x-lf.form.input type="text"
                                            name="option_penance_soons.{{ $key }}.monney_penance_soon"
                                            label="Tiền phạt (VNĐ)" style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 10.000" />
                                    </div>
                                    <div>
                                        @if (count($option_penance_soons) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionPenanceSoon({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionPenanceSoon">Thêm
                                mới</button>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($type == 1)
            <div style="padding: 10px; width: 100%">
                <label style="padding-top: 7px; font-size: 18px;font-weight: bold; ">Luật tính công theo
                    ca:
                    <span style="color: #999">(Tổng thời gian {{ $sum_time_shift }})</span></label>
                <div style="display: flex; padding-bottom: 10px; width:60%">
                    <x-lf.form.input name="input_time_shift" type="time">
                        <x-slot:label>
                            <span>Giờ bắt đầu ca <span class="text-red-500">(*)</span></span>
                        </x-slot:label>
                    </x-lf.form.input>
                    <x-lf.form.input name="output_time_shift" type="time">
                        <x-slot:label>
                            <span>Giờ kết thúc ca <span class="text-red-500">(*)</span></span>
                        </x-slot:label>
                    </x-lf.form.input>
                    <x-lf.form.input name="count_shift" type="number" onClick="this.select();"
                        placeholder="VD: 0.25, 0.5,...">
                        <x-slot:label>
                            <span>Số công <span class="text-red-500">(*)</span></span>
                        </x-slot:label>
                    </x-lf.form.input>
                </div>
                <div style=" border-top:1px solid #DDD; display: flex">
                    <div style="width: 50%">
                        <div style="padding: 10px;">
                            <b style="padding-top: 7px ; font-size: 16px">Luật tính công khi đi muộn</b>
                            @if (!empty($input_time_shift) || !empty($output_time_shift))
                                <p style="padding-top: 5px;color:rgb(255, 0, 0);font-size: 13px">Thời gian
                                    nhập
                                    trong
                                    khoảng từ
                                    {{ $input_time_shift }} đến
                                    {{ $output_time_shift }}</p>
                            @endif

                            @foreach ($option_after_shifts as $key => $option_after_shift)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex;padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input name="option_after_shifts.{{ $key }}.time_after"
                                            type="time" label="Chấm công sau thời gian" style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>
                                        <x-lf.form.input type="number"
                                            name="option_after_shifts.{{ $key }}.count_after"
                                            label="Số công" style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 0.25, 0.5,..." />
                                    </div>
                                    <div>
                                        @if (count($option_after_shifts) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionAfterShift({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionAfterShift">Thêm
                                mới</button>
                        </div>
                    </div>
                    <div style="width: 50%">
                        <div style="padding: 10px;">
                            <b style="padding-top: 7px ; font-size: 16px">Luật tính công khi về sớm</b>
                            @if (!empty($input_time_shift) || !empty($output_time_shift))
                                <p style="padding-top: 5px;color:rgb(255, 0, 0);font-size: 13px">Thời gian
                                    nhập
                                    trong
                                    khoảng từ
                                    {{ $input_time_shift }} đến
                                    {{ $output_time_shift }}</p>
                            @endif
                            @foreach ($option_before_shifts as $key => $option_before_shift)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex;padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input name="option_before_shifts.{{ $key }}.time_before"
                                            type="time" label="Nếu chấm công trước thời gian"
                                            style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>

                                        <x-lf.form.input type="text"
                                            name="option_before_shifts.{{ $key }}.count_before"
                                            label="Số công" style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 0.25, 0.5,..." />
                                    </div>
                                    <div>
                                        @if (count($option_before_shifts) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionBeforeShift({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionBeforeShift">Thêm
                                mới</button>
                        </div>
                    </div>
                </div>

                <div style=" border-top:1px solid #DDD; display: flex">
                    <div style="width: 50%">
                        <div style="padding: 10px;">
                            <b style="padding-top: 7px; font-size: 16px">Luật phạt tiền khi đi muộn</b>

                            @foreach ($option_penance_lates as $key => $option_penance_late)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex;padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input
                                            name="option_penance_lates.{{ $key }}.time_penance_late"
                                            type="number" label="Đi muộn với số phút " style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>
                                        <x-lf.form.input type="text"
                                            name="option_penance_lates.{{ $key }}.monney_penance_late"
                                            label="Tiền phạt (VNĐ)" style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 10.000" />
                                    </div>
                                    <div>
                                        @if (count($option_penance_lates) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionPenanceLate({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionPenanceLate">Thêm
                                mới</button>
                        </div>
                    </div>
                    <div style="width: 50%">
                        <div style="padding: 10px;">
                            <b style="padding-top: 7px; font-size: 16px">Luật phạt tiền khi về sớm</b>

                            @foreach ($option_penance_soons as $key => $option_penance_soon)
                                <div style="display: flex; width: 100%;">
                                    <div style="display: flex;padding-bottom: 10px;width: 80%;">
                                        <a style="margin-top: 40px; font-size: 15px">Nếu</a>
                                        <x-lf.form.input
                                            name="option_penance_soons.{{ $key }}.time_penance_soon"
                                            type="number" label="Về sớm với số phút" style="width: 100%" />
                                        <a style="margin-top: 40px; font-size: 15px">Thì</a>
                                        <x-lf.form.input type="text"
                                            name="option_penance_soons.{{ $key }}.monney_penance_soon"
                                            label="Tiền phạt (VNĐ)" style="width: 100%" onClick="this.select();"
                                            placeholder="VD: 10.000" />
                                    </div>
                                    <div>
                                        @if (count($option_penance_soons) > 1)
                                            <button class="mt-10"
                                                wire:click.prevent="removeOptionPenanceSoon({{ $key }})">{!! lfIcon('delete', 20) !!}</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addOptionPenanceSoon">Thêm
                                mới</button>
                        </div>
                    </div>
                </div>

                <div style="padding: 10px 0; border-top:1px solid #DDD;">
                    <b style="padding-top: 7px; font-size: 16px">Ngày áp dụng</b>
                    <div style="display: flex;">
                        <div style="width: 200px">
                            <x-lf.form.checkbox name="selected" type="checkbox" label="" wire:model="selected"
                                :params="['true' => 'Chọn tất cả']" />
                        </div>
                        <x-lf.form.checkbox name="day_apply" type="checkbox" label="" :params="$day" />
                    </div>
                </div>
            </div>
        @endif

        <x-slot name="tools">
            @can('time-keep.timekeep-rules.show')
                <a class="btn-success sm"
                    href="{{ route('time-keep.timekeep-rules.show', $record_id) }}">{!! lfIcon('launch', 11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{ route('time-keep.timekeep-rules') }}">{!! lfIcon('list', 11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Cập nhật</label>
                <a class="btn" href="{{ route('time-keep.timekeep-rules') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
