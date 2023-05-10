<div class="w-full p-2 md:p-4 max-w-lg">
    <x-lf.card class="success" title="Show">
        <table class="table">
            <tr>
                <th class="text-right pr-2">ID:</th>
                <td>{{$data->id}}</td>
            </tr>
            
			<tr>
				<th class="text-right pr-2">user_id:</th>
				<td>{{$data->user_id}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">place_of_birth:</th>
				<td>{{$data->place_of_birth}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">home_town:</th>
				<td>{{$data->home_town}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">ethnic:</th>
				<td>{{$data->ethnic}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">religion:</th>
				<td>{{$data->religion}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">permanent_address:</th>
				<td>{{$data->permanent_address}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">temporary_residence_address:</th>
				<td>{{$data->temporary_residence_address}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">tax_code:</th>
				<td>{{$data->tax_code}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">id_number:</th>
				<td>{{$data->id_number}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">place_of_issue_of_id_card:</th>
				<td>{{$data->place_of_issue_of_id_card}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">date_of_issue_of_id_card:</th>
				<td>{{$data->date_of_issue_of_id_card}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">relative_phone_number:</th>
				<td>{{$data->relative_phone_number}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">relative_name:</th>
				<td>{{$data->relative_name}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">foreign_language:</th>
				<td>{{$data->foreign_language}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">computer_skill:</th>
				<td>{{$data->computer_skill}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">educational_level:</th>
				<td>{{$data->educational_level}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">academic_level:</th>
				<td>{{$data->academic_level}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">specialized:</th>
				<td>{{$data->specialized}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">insurance_number:</th>
				<td>{{$data->insurance_number}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">insurance_participation_date:</th>
				<td>{{$data->insurance_participation_date}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">registration_address:</th>
				<td>{{$data->registration_address}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">examination_and_treatment:</th>
				<td>{{$data->examination_and_treatment}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">health:</th>
				<td>{{$data->health}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">weight:</th>
				<td>{{$data->weight}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">height:</th>
				<td>{{$data->height}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">bank_name:</th>
				<td>{{$data->bank_name}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">account_number:</th>
				<td>{{$data->account_number}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">note:</th>
				<td>{{$data->note}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">contract_id:</th>
				<td>{{$data->contract_id}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">total_salary:</th>
				<td>{{$data->total_salary}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">salary_received:</th>
				<td>{{$data->salary_received}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">type_contract:</th>
				<td>{{$data->type_contract}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">sign_day:</th>
				<td>{{$data->sign_day}}</td>
			</tr>
			<tr>
				<th class="text-right pr-2">expiration_date:</th>
				<td>{{$data->expiration_date}}</td>
			</tr>
        </table>
        <x-slot name="tools">
            @can("company.staff-infomations.listing")
                <a class="btn-primary xs" href="{{route("company.staff-infomations")}}">{!! lfIcon("list",11) !!}</a>
            @endcan
            @can("company.staff-infomations.edit")
                <a class="btn-warning xs" href="{{route("company.staff-infomations.edit",$data->id)}}">{!! lfIcon("edit",11) !!}</a>
            @endcan
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                @can("company.staff-infomations.listing")
                    <a class="btn-primary" href="{{route("company.staff-infomations")}}">{!! lfIcon("list") !!} <span>Listing</span></a>
                @endcan
                <div>
                    @can("company.staff-infomations.edit")
                        <a class="btn-warning" href="{{route("company.staff-infomations.edit",$data->id)}}">{!! lfIcon("edit") !!} <span>Edit</span></a>
                    @endcan
                </div>
            </div>
        </x-slot>
    </x-lf.card>
</div>
