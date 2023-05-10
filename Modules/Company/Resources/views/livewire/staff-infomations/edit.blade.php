<div class="w-full p-1 md:p-4">
    <x-lf.card title="Cập nhật" class="warning">
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            / Firefox / input[type=number] {
                -moz-appearance: textfield;
            }
        </style>

        <style>
            .button:hover {
                color: red;
                border: none;
                cursor: pointer;
            }

            .boxProfile {
                width: 120px;
                padding: 10px;
                text-align: center;
                border: 1px solid rgb(195 195 195);
                border-bottom: none;
            }

            .boxProfile:hover {
                cursor: pointer;
                background: #f3f4f6;
            }

            .boxIcon {
                display: flex;
                justify-content: center;
            }

            .boxIcon .mcon {
                width: 30px;
                height: 30px;
            }
        </style>


        <div class="w-full" style="border-bottom-width: 1px">
            <div class="w-1/2">
                <div class="button btnOne" style="width: 25%;float: left; text-align:center; padding: 10px"
                    wire:click="buttonClick(1)">
                    <button type="button"><b>Sơ yếu lý lịch</b></button>
                </div>
                <div class="button btnTwo" style="width: 25%;float: left; text-align:center; padding: 10px"
                    wire:click="buttonClick(2)">
                    <button type="button"><b>Hợp đồng</b></button>
                </div>
                <div class="button btnThree" style="width: 25%;float: left; text-align:center; padding: 10px"
                    wire:click="buttonClick(3)">
                    <button type="button"><b>Tài khoản</b></button>
                </div>
                <div class="button btnFour" style="width: 25%;float: left; text-align:center; padding: 10px"
                    wire:click="buttonClick(4)">
                    <button type="button"><b>Công việc</b></button>
                </div>

            </div>
        </div>
        <div class="w-full" style="margin-top: 20px;">
            @if ($buttonClick == 1)
                <style>
                    .btnOne {
                        color: red;
                        border: none;
                        cursor: pointer;
                    }
                </style>
                <div style="padding: 10px 10px 10px 60px; width: 15%; float: left;">
                    <div class="boxProfile one" wire:click="boxProfile(1)">
                        <p class="boxIcon">{!! lfIcon('account') !!}</p>
                        <h3>Cá nhân</h3>
                    </div>
                    <div class="boxProfile two" wire:click="boxProfile(2)">
                        <p class="boxIcon">{!! lfIcon('contact-phone') !!}</p>
                        <h3>Liên lạc</h3>
                    </div>
                    <div class="boxProfile three" wire:click="boxProfile(3)">
                        <p class="boxIcon">{!! lfIcon('award') !!}</p>
                        <h3>Chuyên môn</h3>
                    </div>
                    <div class="boxProfile four" wire:click="boxProfile(4)"
                        style="border-bottom: 1px solid rgb(195 195 195);">
                        <p class="boxIcon">{!! lfIcon('star') !!}</p>
                        <h3>Sức khỏe</h3>
                    </div>
                    <div class="boxProfile five" wire:click="boxProfile(5)"
                        style="border-bottom: 1px solid rgb(195 195 195);">
                        <p class="boxIcon">{!! lfIcon('price') !!}</p>
                        <h3>Tài khoản ngân hàng</h3>
                    </div>
                    <div class="boxProfile six" wire:click="boxProfile(6)"
                        style="border-bottom: 1px solid rgb(195 195 195);">
                        <p class="boxIcon">{!! lfIcon('security') !!}</p>
                        <h3>Hợp đồng đang áp dụng</h3>
                    </div>
                </div>
                <div style="width: 80%;  float: left;">
                    @if ($boxProfile == 1)
                        <style>
                            .one {
                                background: #f3f4f6;
                            }
                        </style>
                        <div style="width: 70%">
                            <div style="width:100%">
                                <x-lf.form.input name="name" type="string">
                                    <x-slot:label>
                                        <span>Tên nhân viên <span class="text-red-500">(*)</span></span>
                                    </x-slot:label>
                                </x-lf.form.input>
                            </div>
                            <div style="width:30%">
                                <x-lf.form.select name="gender" label="Giới tinh" :default="['---Chọn---']"
                                    :params="['0' => 'Nam', '1' => 'Nữ', '2' => 'Khác']" />
                            </div>
                            <div style="width: 100%; display:flex">
                                <div style="width: 40%">
                                    <x-lf.form.input name="birthday" type="date" label="Ngày sinh" />
                                </div>
                                <div style="width: 60%">
                                    <x-lf.form.input name="place_of_birth" type="string" label="Nơi sinh" />
                                </div>
                            </div>
                            <x-lf.form.input name="home_town" type="string">
                                <x-slot:label>
                                    <span>Quê quán <span class="text-red-500">(*)</span></span>
                                </x-slot:label>
                            </x-lf.form.input>

                            <div style="display:flex; width:100%">
                                <div style="width: 50%">
                                    <x-lf.form.input name="ethnic" type="string" label="Dân tộc" />
                                </div>
                                <div style="width: 50%">
                                    <x-lf.form.input name="religion" type="string" label="Tôn giáo" />
                                </div>
                            </div>
                            <x-lf.form.input name="permanent_address" type="string">
                                <x-slot:label>
                                    <span>Địa chỉ thường trú <span class="text-red-500">(*)</span></span>
                                </x-slot:label>
                            </x-lf.form.input>
                            <x-lf.form.input name="temporary_residence_address" type="string">
                                <x-slot:label>
                                    <span>Địa chỉ tạm trú <span class="text-red-500">(*)</span></span>
                                </x-slot:label>
                            </x-lf.form.input>
                        </div>
                    @elseif($boxProfile == 2)
                        <style>
                            .two {
                                background: #f3f4f6;
                            }
                        </style>
                        <div style="width: 70%">
                            <div style="display:flex; width:100%">
                                <div style="width: 40%">
                                    <x-lf.form.input name="phone" type="string" label="Số điện thoại" />
                                </div>
                                <div style="width: 60%">
                                    <x-lf.form.input name="email" type="string" label="Email" />
                                </div>
                            </div>
                            <div style="display:flex; width:100%">
                                <div style="width: 50%">
                                    <x-lf.form.input name="facebook" type="string" label="Facebook" />
                                </div>
                                <div style="width: 50%">
                                    <x-lf.form.input name="zalo" type="string" label="Zalo" />
                                </div>
                            </div>
                            <x-lf.form.input name="tax_code" type="integer" label="Mã số thuế" />
                            <div style="display:flex; width:100%">
                                <div style="width: 60%">
                                    <x-lf.form.input name="id_number" type="integer" label="Số CMND/CCCD" />
                                </div>
                                <div style="width: 40%">
                                    <x-lf.form.input name="date_of_issue_of_id_card" type="date"
                                        label="Ngày cấp CMND/CCCD" />

                                </div>
                            </div>
                            <x-lf.form.input name="place_of_issue_of_id_card" type="string"
                                label="Nơi cấp CMND/CCCD" />
                            <div style="display:flex; width:100%">
                                <div style="width: 50%">
                                    <x-lf.form.input name="relative_name" type="string" label="Tên người thân" />
                                </div>
                                <div style="width: 50%">
                                    <x-lf.form.input name="relative_phone_number" type="string"
                                        label="Số điện thoại người thân" />
                                </div>
                            </div>

                        </div>
                    @elseif($boxProfile == 3)
                        <style>
                            .three {
                                background: #f3f4f6;
                            }
                        </style>
                        <div style="width: 70%">
                            <x-lf.form.input name="academic_level" type="string" label="Trình độ học vấn" />
                            <x-lf.form.input name="specialized" type="string" label="Chuyên ngành" />
                            <x-lf.form.input name="computer_skill" type="string" label="Trình độ tin học" />
                            <x-lf.form.input name="educational_level" type="string" label="Trình độ văn hóa" />
                            <x-lf.form.input name="foreign_language" type="string" label="Ngoại ngữ" />

                        </div>
                    @elseif($boxProfile == 4)
                        <style>
                            .four {
                                background: #f3f4f6;
                            }
                        </style>
                        <div style="width: 70%">
                            <div>
                                <div style="width: 60%; float: left;">
                                    <x-lf.form.input name="insurance_number" type="string" label="Số bảo hiểm" />
                                </div>
                                <div style="width: 40%; float: left;">
                                    <x-lf.form.input name="insurance_participation_date" type="date"
                                        label="Ngày tham gia bảo hiểm" />
                                </div>
                            </div>
                            <x-lf.form.input name="registration_address" type="string" label="Địa chỉ đăng ký" />
                            <x-lf.form.input name="examination_and_treatment" type="string"
                                label="Nơi khám chữa bệnh" />
                            <x-lf.form.input name="health" type="string" label="Sức khỏe" />
                            <div>
                                <div style="width: 50%; float: left; position: relative;">
                                    <x-lf.form.input name="weight" type="integer" label="Cân nặng (kg)"
                                        placeholder="50kg, ..." />

                                </div>
                                <div style="width: 50%; float: left; position: relative;">
                                    <x-lf.form.input name="height" type="integer" label="Chiều cao (cm)"
                                        placeholder="160cm, ..." />

                                </div>
                            </div>
                        </div>
                    @elseif($boxProfile == 5)
                        <style>
                            .five {
                                background: #f3f4f6;
                            }
                        </style>
                        <div style="width:70%">
                            <x-lf.form.input name="bank_name" type="string" label="Tên ngân  hàng" />
                            <x-lf.form.input name="account_number" type="integer" label="Mã số tài khoản" />
                            <x-lf.form.textarea name="note" type="string" label="Ghi chú" />
                        </div>
                    @elseif($boxProfile == 6)
                        <style>
                            .six {
                                background: #f3f4f6;
                            }
                        </style>
                        <div style="width:70%">
                            <x-lf.form.input name="contract_id" type="string" label="ID hợp đồng" disabled />
                            <x-lf.form.select name="type_contract" label="Loại hợp đồng" :default="['---Chọn---']"
                                :params="[0 => 'Học nghề', 1 => 'Thử việc', 2 => 'Lao động']" disabled />
                            <div style="display:flex; width:100%">
                                <div style="width: 50%">
                                    <x-lf.form.input name="sign_day" type="date" label="Ngày bắt đầu" disabled />
                                </div>
                                <div style="width: 50%">
                                    <x-lf.form.input name="expiration_date" type="date" label="Ngày kết thúc"
                                        disabled />
                                </div>
                            </div>
                            <x-lf.form.input name="total_salary" type="string" label="Tổng lương" disabled />
                            <x-lf.form.input name="salary_received" type="string" label="Lương được lãnh"
                                disabled />
                        </div>
                    @endif
                </div>
            @elseif($buttonClick == 2)
                <style>
                    .btnTwo {
                        color: red;
                        border: none;
                        cursor: pointer;
                    }

                    table {
                        margin: 10px;
                    }

                    th {
                        padding: 10px 20px;
                        border: 1px solid rgb(230 230 230);
                    }

                    td {
                        padding: 10px 20px;
                        border: 1px solid rgb(230 230 230);
                    }
                </style>
                <a class="btn-success sm" href="{{ route('company.contracts.create', $profile_id) }}"
                    style="margin:10px">Thêm mới
                    hợp đồng</a>
                <table>
                    <thead>
                        <tr>
                            <th>Tên nhân viên</th>
                            <th>Số hợp đồng</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Lương tổng</th>
                            <th>Lương thực lãnh</th>
                            <th>Lương cơ bản</th>
                            <th>Áp dụng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($contracts))
                            @foreach ($contracts as $contract)
                                <tr>

                                    @foreach ($users as $k => $user)
                                        @if ($k == $contract->profile_id)
                                            <td>{{ $user }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $contract->some_contracts }}</td>
                                    <td>{{ $contract->effective_date }}</td>
                                    <td>{{ $contract->expiration_date }}</td>
                                    <td>{{ number_format(floatval($contract->total_salary), 0, ',', '.') }}</td>
                                    <td>{{ number_format(floatval($contract->salary_received), 0, ',', '.') }}</td>
                                    <td>{{ number_format(floatval($contract->basic_salary), 0, ',', '.') }}</td>
                                    <td>
                                        @if (strtotime($contract->expiration_date) >= $day)
                                            <x-lf.btn.toggle :val="$contract->active"
                                                wire:change="changeActive({{ $contract->id }})" />
                                        @else
                                            <button onclick="clickMe()">
                                                <img src="/photos/expired1.png" alt="" width="70px"
                                                    height="70px">
                                            </button>
                                        @endif

                                    </td>
                                    <td>
                                        <a class="btn-info xs"
                                            href="{{ route('company.contracts.edit', $contract->id) }}">{!! lfIcon('edit', 10) !!}</a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            @elseif($buttonClick == 3)
                <style>
                    .btnThree {
                        color: red;
                        border: none;
                        cursor: pointer;
                    }
                </style>
                <div>

                    @if (!empty($user_id1))
                        <div style="width:50%">
                            <x-lf.form.input name="user_name" type="string" label="Tài khoản" disabled />
                        </div>
                        <div style="width:50%">
                            <x-lf.form.input name="phone1" type="number" label="Số điện thoại" disabled />
                        </div>
                        <div style="width:50%">
                            <x-lf.form.input name="email1" type="string" label="Email" disabled />
                        </div>
                        {{-- <div style="width:50%">
                            <x-lf.form.input name="password" type="password" label="Mật khẩu" disabled />
                        </div> --}}

                        <div style="width:50%; margin:10px;display:flex">
                            <div style="padding-right: 20px; font-size: 13px">
                                <b>Quyền quản lý</b>
                            </div>
                            <div>
                                <x-lf.btn.toggle :val="$is_admin" wire:change="changeIsAdmin({{ $user_id1 }})" />
                            </div>
                        </div>
                    @else
                        <a class="btn-success sm" style="margin: 10px" wire:click="createUser">Thêm tài
                            khoản</a>
                        <div style="width:50%">
                            <x-lf.form.input name="user_name" type="string" label="Tài khoản" disabled />
                        </div>
                        <div style="width:50%">
                            <x-lf.form.input name="phone1" type="number" label="Số điện thoại" />
                        </div>
                        <div style="width:50%">
                            <x-lf.form.input name="email1" type="email" label="Email" />
                        </div>
                        <div style="width:50%">
                            <x-lf.form.input name="password" type="password" label="Mật khẩu" />
                        </div>
                        <div>
                            <x-lf.form.toggle name="is_admin" label="Quyền quản lý" />
                        </div>
                    @endif

                </div>
            @elseif($buttonClick == 4)
                <style>
                    .btnFour {
                        color: red;
                        border: none;
                        cursor: pointer;
                    }
                </style>
                <div style="width:40%">
                    <x-lf.form.select name="company_id" type="integer" label="Công ty" :default="['---Chọn---']"
                        :params="$companies" />
                    <x-lf.form.select name="department_id" type="integer" label="Phòng ban" :default="['---Chọn---']"
                        :params="$departments" />

                    <x-lf.form.select name="position_id" type="integer" label="Chức vụ" :default="['---Chọn---']"
                        :params="$positions" />
                    <x-lf.form.select name="timekeep_rule" type="integer" label="Luật chấm công" :default="['---Chọn---']"
                        :params="$timekeepRules" />
                </div>
            @endif
        </div>


        <x-slot name="tools">
            @can('company.staff-infomations.show')
                <a class="btn-success sm"
                    href="{{ route('company.staff-infomations.show', $record_id) }}">{!! lfIcon('launch', 11) !!}</a>
            @endcan
            <a class="btn-primary sm" href="{{ route('company.staff-infomations') }}">{!! lfIcon('list', 11) !!}</a>
        </x-slot>
        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Cập nhật</label>
                <a class="btn" href="{{ route('company.staff-infomations') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
<script>
    function clickMe() {
        alert('Hợp đồng đã hết hạn');
    }
</script>
