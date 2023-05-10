<div class="w-1/2 p-1 md:p-4">
    <x-lf.card title="Thêm" class="info">

        <x-lf.form.input name="name" type="string" label="Tên nhân viên" placeholder="Tên nhân viên ..." />

        <x-lf.form.input name="email" type="string" label="Email" placeholder="Email ..." />

        <x-lf.form.input name="password" type="password" label="Mật khẩu" placeholder="Mật khẩu ..." />

        {{-- <x-lf.form.select name="timekeep_rule" type="integer" label="Luật chấm công" :default="['---Chọn---']" :params="$timekeepRules"
            disabled /> --}}

        <x-lf.form.toggle name="is_admin" label="Is admin" />

        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Thêm mới</label>
                <a class="btn" href="{{ route('company.users') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
