<div class="w-full p-1 md:p-4">
    <x-lf.card title="Cập nhật" class="warning">
        <x-lf.form.input name="name" type="string" label="Tên cấp bậc" />
        <x-lf.form.select name="company_id" type="integer" label="Công ty" :default="['---Chọn---']" :params="$companies" />
        <x-lf.form.input name="level" type="integer" label="Mức độ" />

        <x-slot name="tools">
            @can('company.positions.show')
                <a class="btn-success sm"
                    href="{{ route('company.positions.show', $record_id) }}">{!! lfIcon('launch', 11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{ route('company.positions') }}">{!! lfIcon('list', 11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Cập nhật</label>
                <a class="btn" href="{{ route('company.positions') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
