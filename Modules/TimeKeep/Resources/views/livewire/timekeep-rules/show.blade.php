<div class="w-full p-2 md:p-4 max-w-lg">
    <x-lf.card class="success" title="Show">
        <table class="table">
            <tr>
                <th class="text-right pr-2">ID:</th>
                <td>{{$data->id}}</td>
            </tr>
            
			<tr>
				<th class="text-right pr-2">name:</th>
				<td>{{$data->name}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">value:</th>
				<td>{{$data->value}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">status:</th>
				<td>{{$data->status}}</td>
			</tr>
        </table>
        <x-slot name="tools">
            @can("time-keep.timekeep-rules.listing")
                <a class="btn-primary xs" href="{{route("time-keep.timekeep-rules")}}">{!! lfIcon("list",11) !!}</a>
            @endcan
            @can("time-keep.timekeep-rules.edit")
                <a class="btn-warning xs" href="{{route("time-keep.timekeep-rules.edit",$data->id)}}">{!! lfIcon("edit",11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can("time-keep.timekeep-rules.listing")
                    <a class="btn-primary" href="{{route("time-keep.timekeep-rules")}}">{!! lfIcon("list") !!} <span>Listing</span></a>
                @endcan
                <div>
                    @can("time-keep.timekeep-rules.edit")
                        <a class="btn-warning" href="{{route("time-keep.timekeep-rules.edit",$data->id)}}">{!! lfIcon("edit") !!} <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
