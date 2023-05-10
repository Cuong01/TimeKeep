<x-lf.page.listing :fields="$fields" :footer="$data->onEachSide(3)->links()">
    <table class="table">
        <thead>
        <tr>
            <th><x-lf.form.sort name="sId" :value="$sId">#</x-lf.form.sort></th>
            <x-lf.table.label name="user_id" :fields="$fields">User Id</x-lf.table.label>
			<x-lf.table.label name="name" :fields="$fields">Name</x-lf.table.label>
			<x-lf.table.label name="some_contracts" :fields="$fields">Some Contracts</x-lf.table.label>
			<x-lf.table.label name="sign_day" :fields="$fields">Sign Day</x-lf.table.label>
			<x-lf.table.label name="type" :fields="$fields">Type</x-lf.table.label>
			<x-lf.table.label name="effective_date" :fields="$fields">Effective Date</x-lf.table.label>
			<x-lf.table.label name="expiration_date" :fields="$fields">Expiration Date</x-lf.table.label>
			<x-lf.table.label name="type_of_work" :fields="$fields">Type Of Work</x-lf.table.label>
			<x-lf.table.label name="rank" :fields="$fields">Rank</x-lf.table.label>
			<x-lf.table.label name="total_salary" :fields="$fields">Total Salary</x-lf.table.label>
			<x-lf.table.label name="salary_received" :fields="$fields">Salary Received</x-lf.table.label>
			<x-lf.table.label name="basic_salary" :fields="$fields">Basic Salary</x-lf.table.label>
			<x-lf.table.label name="pay_forms" :fields="$fields">Pay Forms</x-lf.table.label>
			<x-lf.table.label name="salary_paid_for_insurance" :fields="$fields">Salary Paid For Insurance</x-lf.table.label>
			<x-lf.table.label name="salary_percentage" :fields="$fields">Salary Percentage</x-lf.table.label>
			<x-lf.table.label name="salary_allowance" :fields="$fields">Salary Allowance</x-lf.table.label>
			<x-lf.table.label name="signed_representative" :fields="$fields">Signed Representative</x-lf.table.label>
			<x-lf.table.label name="position_id" :fields="$fields">Position Id</x-lf.table.label>
			<x-lf.table.label name="note" :fields="$fields">Note</x-lf.table.label>
			<x-lf.table.label name="file" :fields="$fields">File</x-lf.table.label>
			<x-lf.table.label name="created_at" :fields="$fields">Created At</x-lf.table.label>
			<x-lf.table.label name="updated_at" :fields="$fields">Updated At</x-lf.table.label>
			
            <th></th>
        </tr>
        </thead>
        @foreach($data as $item)
            <tr>
                <th class="stt">{{$item->id}}</th>
                <x-lf.table.item name="user_id" :fields="$fields">{{$item->user_id}}</x-lf.table.item>
				<x-lf.table.item name="name" :fields="$fields">{{$item->name}}</x-lf.table.item>
				<x-lf.table.item name="some_contracts" :fields="$fields">{{$item->some_contracts}}</x-lf.table.item>
				<x-lf.table.item name="sign_day" :fields="$fields">{{$item->sign_day}}</x-lf.table.item>
				<x-lf.table.item name="type" :fields="$fields">{{$item->type}}</x-lf.table.item>
				<x-lf.table.item name="effective_date" :fields="$fields">{{$item->effective_date}}</x-lf.table.item>
				<x-lf.table.item name="expiration_date" :fields="$fields">{{$item->expiration_date}}</x-lf.table.item>
				<x-lf.table.item name="type_of_work" :fields="$fields">{{$item->type_of_work}}</x-lf.table.item>
				<x-lf.table.item name="rank" :fields="$fields">{{$item->rank}}</x-lf.table.item>
				<x-lf.table.item name="total_salary" :fields="$fields">{{$item->total_salary}}</x-lf.table.item>
				<x-lf.table.item name="salary_received" :fields="$fields">{{$item->salary_received}}</x-lf.table.item>
				<x-lf.table.item name="basic_salary" :fields="$fields">{{$item->basic_salary}}</x-lf.table.item>
				<x-lf.table.item name="pay_forms" :fields="$fields">{{$item->pay_forms}}</x-lf.table.item>
				<x-lf.table.item name="salary_paid_for_insurance" :fields="$fields">{{$item->salary_paid_for_insurance}}</x-lf.table.item>
				<x-lf.table.item name="salary_percentage" :fields="$fields">{{$item->salary_percentage}}</x-lf.table.item>
				<x-lf.table.item name="salary_allowance" :fields="$fields">{{$item->salary_allowance}}</x-lf.table.item>
				<x-lf.table.item name="signed_representative" :fields="$fields">{{$item->signed_representative}}</x-lf.table.item>
				<x-lf.table.item name="position_id" :fields="$fields">{{$item->position_id}}</x-lf.table.item>
				<x-lf.table.item name="note" :fields="$fields">{{$item->note}}</x-lf.table.item>
				<x-lf.table.item name="file" :fields="$fields">{{$item->file}}</x-lf.table.item>
				<x-lf.table.item name="created_at" :fields="$fields">{{$item->created_at}}</x-lf.table.item>
				<x-lf.table.item name="updated_at" :fields="$fields">{{$item->updated_at}}</x-lf.table.item>
				
                <td class="action">
                    @can('company.contracts.show')
                    <a class="btn-success xs" href="{{route("company.contracts.show",$item->id)}}">{!! lfIcon("launch",10) !!}</a>
                    @endcan
                    @can('company.contracts.edit')
                    <a class="btn-info xs" href="{{route("company.contracts.edit",$item->id)}}">{!! lfIcon("edit",10) !!}</a>
                    @endcan
                    @can('company.contracts.delete')
                    <x-lf.btn.delete :record="$item->id" :confirm="$confirm"/>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    <x-slot name="filters">
        <x-lf.filter.input name="fId" type="number" placeholder="Id ..." />
    </x-slot>
    <x-slot name="tools">
        @can("company.contracts.create")
           <div> <a class="btn-primary sm" href="{{route("company.contracts.create")}}">{!! lfIcon("add") !!}</a></div>
        @endcan
    </x-slot>
</x-lf.page.listing>
