<div class="w-full p-1 md:p-4">
    <x-lf.card title="Cập nhật" class="warning">
        <div style="width:25%">
            <x-lf.form.select name="profile_id" type="integer" label="Tên nhân viên" :default="['---Chọn---']" :params="$users"
                disabled />
        </div>

        <div style="display:flex; width:100%">
            <div style="width:50%">
                <x-lf.form.input name="some_contracts" type="string">
                    <x-slot:label>
                        <span>Số hợp đồng <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
            </div>
            <div style="width:50%">
                <x-lf.form.input name="name" type="string">
                    <x-slot:label>
                        <span>Tên hợp đồng <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
            </div>
        </div>

        <div style="width:25%">
            <x-lf.form.select name="type" label="Loại hợp đồng" :default="['---Chọn---']" :params="[0 => 'Học nghề', 1 => 'Thử việc', 2 => 'Lao động']" />
        </div>

        <div style="display: flex;width:100%">
            <div style="width:25%">
                <x-lf.form.input name="sign_day" type="date" label="Ngày ký" />
            </div>
            <div style="width:25%">
                <x-lf.form.input name="effective_date" type="date">
                    <x-slot:label>
                        <span>Ngày bắt đầu hợp đồng <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
            </div>
            <div style="width:25%">
                <x-lf.form.input name="expiration_date" type="date">
                    <x-slot:label>
                        <span>Ngày kết thúc hợp đồng <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
            </div>
            <div style="width:25%">
                <x-lf.form.select name="type_of_work" label="Loại công việc" :default="['---Chọn---']" :params="$departments" />
            </div>

        </div>

        <div style="width:25%">
            <x-lf.form.select name="rank" label="Cấp bậc" :default="['---Chọn---']" :params="$positions" />
        </div>
        <div style="display: flex;width:100%">

            <div style="width:25%">
                <x-lf.form.input name="total_salary" type="integer">
                    <x-slot:label>
                        <span>Tổng lương (VNĐ) <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
            </div>
            <div style="width:25%">
                <x-lf.form.input name="salary_received" type="integer">
                    <x-slot:label>
                        <span>Lương thực lãnh (VNĐ) <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
            </div>
            <div style="width:25%">
                <x-lf.form.input name="basic_salary" type="integer">
                    <x-slot:label>
                        <span>Lương cơ bản (VNĐ) <span class="text-red-500">(*)</span></span>
                    </x-slot:label>
                </x-lf.form.input>
            </div>
            <div style="width:25%">
                <x-lf.form.select name="pay_forms" label="Hình thức trả lương" :default="['---Chọn---']" :params="[0 => 'Tiền mặt', 1 => 'Chuyển khoản']" />
            </div>

        </div>

        <div style="display: flex;width:100%">
            <div style="width:25%">
                <x-lf.form.input name="salary_paid_for_insurance" type="integer"
                    label="Mức lương đóng bảo hiểm (VNĐ)" />
            </div>
            <div style="width:25%">
                <x-lf.form.input name="salary_percentage" type="integer" label="Phần trăm lương hưởng (%)" />
            </div>
            <div style="width:25%">
                <x-lf.form.input name="salary_allowance" type="integer" label="Lương trợ cấp (VNĐ)" />
            </div>
        </div>

        <div style="width:25%">
            <x-lf.form.select name="signed_representative" type="integer" label="Người đại diện công ty ký hợp đồng"
                :default="['---Chọn---']" :params="$users" />
        </div>
        <div style="width:25%">
            <x-lf.form.select name="position_id" type="integer" label="Chức vụ người đại diện" :default="['---Chọn---']"
                :params="$positions" />

        </div>

        <x-lf.form.textarea name="note" type="string" label="Ghi chú" />
        <x-lf.form.picture name="file" label="Ảnh" :src="$file_url" />

        <x-slot name="footer">
            <div class="card-footer flex justify-between">
                <label class="btn-primary flex-none" wire:click="store">Cập nhật</label>
                <a class="btn" href="{{ route('company.contracts') }}">Hủy bỏ</a>
            </div>
        </x-slot>
    </x-lf.card>
</div>
