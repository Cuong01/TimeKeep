<div class="w-full p-1 md:p-4">
    <x-lf.card title="Create" class="info">
		<x-lf.form.input name="company_id" type="string" label="Company id" placeholder="Company id ..."/>
		<x-lf.form.radio name="status" type="string" label="Status" placeholder="Status ..."/>
		<x-lf.form.input name="note" type="string" label="Note" placeholder="Note ..."/>
		
        <x-lf.form.done />
        <x-slot name="tools">
            <a class="btn-primary sm" href="{{route('time-keep.timekeeps')}}">{!! lfIcon("list") !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Create</label>
                <a class="btn" href="{{route("time-keep.timekeeps")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>



