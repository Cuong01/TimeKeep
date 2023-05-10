<div class="w-full p-1 md:p-4">
    <x-lf.card title="Thêm" class="info">
        <x-lf.form.input name="name" type="string" label="Tên cấp bậc" />
        <x-lf.form.select name="company_id" type="integer" label="Công ty" :default="['---Chọn---']" :params="$companies" />
        <x-lf.form.input name="level" type="integer" label="Mức độ" />

        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Thêm mới</label>
                <a class="btn" href="{{ route('company.positions') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
