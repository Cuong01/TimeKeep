<div class="w-full p-1 md:p-4">
    <x-lf.card title="Thêm" class="info">
        <div style="width:50%">
            <x-lf.form.input name="name" type="string">
                <x-slot:label>
                    <span>Tên công ty <span class="text-red-500">(*)</span></span>
                </x-slot:label>
            </x-lf.form.input>
        </div>
        <div style="width:50%">
            <x-lf.form.input name="slug" type="string">
                <x-slot:label>
                    <span>Slug <span class="text-red-500">(*)</span></span>
                </x-slot:label>
            </x-lf.form.input>
        </div>
        <x-lf.form.textarea name="teaser" type="string">
            <x-slot:label>
                <span>Giới thiệu <span class="text-red-500">(*)</span></span>
            </x-slot:label>
        </x-lf.form.textarea>
        <x-lf.form.picture name="logo_file" label="logo" :src="$logo_url" />
        <div style="display: flex">
            <x-lf.form.input name="width" type="string" label="Chiều rộng" disabled />
            <x-lf.form.input name="height" type="string" label="Chiều cao" disabled />
        </div>
        <x-lf.form.input name="address" type="string" label="Địa chỉ" />
        <div style="width:50%">
            <x-lf.form.input name="phone" type="string" label="Số điện thoại" />
        </div>
        <div style="width:50%">
            <x-lf.form.select name="parent_id" type="integer" label="Thuộc công ty" :default="['---Chọn---']"
                :params="$companies" />
        </div>
        <x-lf.form.toggle name="active" label="Trạng thái" />


        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Thêm mới</label>
                <a class="btn" href="{{ route('company.companies') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
