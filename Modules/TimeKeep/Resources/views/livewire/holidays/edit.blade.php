<div class="w-full p-1 md:p-4" style="width:50%">
    <x-lf.card title="Cập nhật" class="warning">
        <div style="width:100%">
            <x-lf.form.input name="name" type="string" onClick="this.select();" style="padding-left:10px">
                <x-slot:label>
                    <span>Tên ngày lễ <span class="text-red-500">(*)</span></span>
                </x-slot:label>
            </x-lf.form.input>
            <div style="display:flex">
                <x-lf.form.input name="from_day" type="date">
                    <x-slot:label>
                        <span>Nghỉ từ ngày <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
                <x-lf.form.input name="to_day" type="date">
                    <x-slot:label>
                        <span>Đến ngày <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
            </div>
            <div style="display:flex; width:50%">
                <x-lf.form.input name="salary_half" type="string" placeholder="VD: 100%,...">
                    <x-slot:label>
                        <span>Phần trăm lương nghỉ lễ <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
                <a style="padding-top: 40px">%</a>
            </div>
            <div style="display:flex; width:50%">
                <x-lf.form.input name="salary_working" type="string" placeholder="VD: 200%,...">
                    <x-slot:label>
                        <span>Phần trăm lương đi làm ngày lễ <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
                <a style="padding-top: 40px">%</a>
            </div>
            <x-lf.form.toggle name="status" label="Trạng thái" />
        </div>

        <x-slot name="tools">
            @can('time-keep.holidays.show')
                <a class="btn-success sm"
                    href="{{ route('time-keep.holidays.show', $record_id) }}">{!! lfIcon('launch', 11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{ route('time-keep.holidays') }}">{!! lfIcon('list', 11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Cập nhật</label>
                <a class="btn" href="{{ route('time-keep.holidays') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
