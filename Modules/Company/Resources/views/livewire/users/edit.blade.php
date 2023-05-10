<div class="w-full p-1 md:p-4">
    <x-lf.card title="Cập nhật" class="warning">
        <div style="width:50%">
            <x-lf.form.input name="name" type="string" label="Tên nhân viên" placeholder="Tên nhân viên ..." />
        </div>
        <div style="display:flex;width:100%">
            <div style="width:50%">
                <x-lf.form.input name="email" type="string" label="Email" placeholder="Email ..." />
            </div>
            <div style="width:50%">
                <x-lf.form.input name="password" type="string" label="Mật khẩu" placeholder="Mật khẩu ..." />
            </div>
        </div>
        <div style="width:50%">
            <x-lf.form.select name="timekeep_rule" type="integer" label="Luật chấm công" :default="['---Chọn---']"
                :params="$timekeepRules" disabled />
        </div>
        <x-lf.form.toggle name="is_admin" label="Is admin" />

        <x-slot name="tools">
            @can('company.users.show')
                <a class="btn-success sm" href="{{ route('company.users.show', $record_id) }}">{!! lfIcon('launch', 11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{ route('company.users') }}">{!! lfIcon('list', 11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Cập nhật</label>
                <a class="btn" href="{{ route('company.users') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
