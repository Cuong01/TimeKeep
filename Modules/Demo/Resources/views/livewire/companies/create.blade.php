<div class="w-full p-1 md:p-4">
    <x-lf.card title="Create" class="info">
        <x-lf.form.input name="name" type="string" label="Name" placeholder="Name ..."/>
		<x-lf.form.input name="slug" type="string" label="Slug" placeholder="Slug ..."/>
		<x-lf.form.input name="teaser" type="string" label="Teaser" placeholder="Teaser ..."/>
		<x-lf.form.array name="logo" label="Logo" placeholder="Logo ..." :params="$logo"/>
		<x-lf.form.input name="address" type="string" label="Address" placeholder="Address ..."/>
		<x-lf.form.input name="phone" type="string" label="Phone" placeholder="Phone ..."/>
		<x-lf.form.input name="parent_id" type="integer" label="Parent id" placeholder="Parent id ..."/>
		<x-lf.form.toggle name="active" label="Active" />
		
        <x-lf.form.done />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('demo.companies')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Create</label>
                <a class="btn" href="{{route("demo.companies")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>



