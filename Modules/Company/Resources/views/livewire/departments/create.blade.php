<div class="w-full p-1 md:p-4">
    <x-lf.card title="Thêm" class="info">
        <x-lf.form.input name="name" type="string">
            <x-slot:label>
                <span>Tên phòng ban <span class="text-red-500">(*)</span></span>
            </x-slot:label>
        </x-lf.form.input>
        <x-lf.form.select name="company_id" type="integer" label="Công ty" :default="['---Chọn---']" :params="$companies" />
        <x-lf.form.select name="parent_id" type="integer" label="Thuộc phòng ban" :default="['---Chọn---']" :params="$departments" />
        {{-- <x-lf.form.input name="root_id" type="integer" label="Root id" placeholder="Root id ..." /> --}}

        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Thêm mới</label>
                <a class="btn" href="{{ route('company.departments') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
