<div class="w-full p-1 md:p-4" style="width:50%">
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
        <x-lf.form.input name="name" type="string" onClick="this.select();" style="padding-left:10px">
            <x-slot:label>
                <span>Tên loại nghỉ <span class="text-red-500">(*)</span></span>
            </x-slot:label>
        </x-lf.form.input>
        <div style="display: flex; width:100%">
            <div style=" width:50%">
                <x-lf.form.input name="salary" type="number" onClick="this.select();" style="padding-left:10px">
                    <x-slot:label>
                        <span>Số lương được nhận <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
            </div>
            <div style=" width:50%">
                <x-lf.form.input name="day" type="number" label="Số ngày nghỉ tối đa" />

            </div>
        </div>
        <x-lf.form.toggle name="status" type="integer" label="Trạng thái" />

        <x-slot name="tools">
            @can('time-keep.applications.show')
                <a class="btn-success sm"
                    href="{{ route('time-keep.applications.show', $record_id) }}">{!! lfIcon('launch', 11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{ route('time-keep.applications') }}">{!! lfIcon('list', 11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Cập nhật</label>
                <a class="btn" href="{{ route('time-keep.applications') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
