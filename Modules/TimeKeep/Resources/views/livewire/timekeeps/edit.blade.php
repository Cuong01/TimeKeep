<div class="w-full p-1 md:p-4">
    <x-lf.card title="Edit" class="warning">
        <x-lf.form.input name="user_id" type="integer" label="User id" placeholder="User id ..."/>
		<x-lf.form.input name="time" type="string" label="Time" placeholder="Time ..."/>
		<x-lf.form.input name="company_id" type="string" label="Company id" placeholder="Company id ..."/>
		<x-lf.form.input name="status" type="string" label="Status" placeholder="Status ..."/>
		<x-lf.form.input name="note" type="string" label="Note" placeholder="Note ..."/>
		
        <x-lf.form.done :params="['Listing','Create','Show']"/>
        <x-slot name="tools" >
            @can('time-keep.timekeeps.show')
            <a class="btn-success sm" href="{{route('time-keep.timekeeps.show',$record_id)}}">{!! lfIcon("launch",11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{route('time-keep.timekeeps')}}">{!! lfIcon("list",11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Update</label>
                <a class="btn" href="{{route("time-keep.timekeeps")}}">Cancel</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>

