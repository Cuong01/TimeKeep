<div class="w-full p-1 md:p-4">
    <x-lf.card title="Edit" class="warning">
        <x-lf.form.input name="name" type="string" label="Name" placeholder="Name ..."/>
		<x-lf.form.input name="label" type="string" label="Label" placeholder="Label ..."/>
		<x-lf.form.input name="slug" type="string" label="Slug" placeholder="Slug ..."/>
        <x-lf.form.icon name="icon" :val="$icon"  label="Icon" placeholder="Icon ..."/>
		<x-lf.form.input name="permission" type="string" label="Permission" placeholder="Permission ..."/>

        <x-lf.form.done :params="['Listing','Create','Show']"/>
        <x-slot name="tools" >
            @can('admin.modules.show')
            <a class="btn-success sm" href="{{route('admin.modules.show',$record_id)}}">{!! lfIcon("launch",11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{route('admin.modules')}}">{!! lfIcon("list",11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Update</label>
                <a class="btn" href="{{route("admin.modules")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>

