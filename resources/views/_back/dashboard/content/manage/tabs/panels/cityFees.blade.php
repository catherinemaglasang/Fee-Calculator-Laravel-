<div class="alert alert-info" v-on="click: say()">

</div>

<style>

</style>

<table class="table">
    <tbody>
        <tr>
            <th class="text-center">City</th>
            <th class="text-center">Fee Name</th>
            <th class="text-center">Fee Amount</th>
            <th class="text-center">Start Date</th>
            <th class="text-center">End Date</th>
            <th class="text-center">Action</th>
        </tr>
        <tr v-repeat="cityFee in citiesFees" v-transition="staggered" stagger="30">
            <td>@{{ cityFee.city_name }}</td>
            <td class="text-center">@{{ cityFee.fee_name }}</td>

            <td class="text-center"><input v-attr="disabled: cityFee.button" class="edit-input" v-model="cityFee.fee_amount" type="number" value="@{{ cityFee.fee_amount }}"></td>

            <td class="text-center"><input v-attr="disabled: cityFee.button" class="edit-input datepicker" type="date" v-model="cityFee.formatted_start_date" value="@{{ cityFee.formatted_start_date }}"></td>
            <td class="text-center"><input v-attr="disabled: cityFee.button" class="edit-input datepicker" type="date" v-model="cityFee.formatted_end_date" value="@{{ cityFee.formatted_end_date }}"></td>
            <td class="text-center actions">
                <button v-on="click: editThis(cityFee)" style="width: 40px; font-size: 10px;"  class="manage-btn edit-btn">@{{ cityFee.edit }}</button>
                <button v-on="click: updateThis(cityFee)"  style="width: 42px; font-size: 10px;" class="manage-btn update-btn" v-attr="disabled: cityFee.button">Update</button>
            </td>
        </tr>
    </tbody>
</table>