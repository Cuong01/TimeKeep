<div class="w-full p-1 md:p-4">
    <x-lf.card title="Create" class="info">
        <x-lf.form.input name="name" type="string" label="Name" placeholder="Name ..."/>
		<x-lf.form.input name="label" type="string" label="Label" placeholder="Label ..."/>
		<x-lf.form.input name="slug" type="string" label="Slug" placeholder="Slug ..."/>
		<x-lf.form.icon name="icon" :val="$icon"  label="Icon" placeholder="Icon ..."/>
		<x-lf.form.input name="permission" type="string" label="Permission" placeholder="Permission ..."/>

        <x-lf.form.done />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('admin.modules')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Create</label>
                <a class="btn" href="{{route("admin.modules")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>



