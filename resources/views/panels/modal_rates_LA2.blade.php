<style>
    #data-one-options {
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }

    #data-one-options td, th {
        text-align: left;
    }

    .checkpoint-modal-inner {
        width: 800px !important;
    }
</style>


<div class="checkpoint-modal" ng-if="sales_tax_rates.modal" ng-cloak ng-model="params.modals.rates" modal>
    <div class="checkpoint-modal-inner">
        <a class="close" href="#" ng-click="closeRatesModal()"><i class="fa fa-times-circle"></i></a>
        <label>Tax Rates Information</label>
        <ul>

            <table id="data-one-options">
                <thead>
                <tr>
                    <th>Parish</th>
                    <th>City</th>
                    <th>Area Code</th>
                    <th>Area Tax</th>
                    <th>Discount</th>
                    <th>Parish Tax</th>
                    <th>Discount</th>
                </tr>
                </thead>

                <tbody>
                {{--<tr>
                    <td>@{{ params['county'] }}</td>
                    <td>@{{ params['city'] }}</td>
                    <td>@{{ params['Sales Tax Rate']['area_code'] }}</td>
                    <td>@{{ params['Sales Tax Rate']['area_tax'] | percentage }}</td>
                    <td>@{{ params['Sales Tax Rate']['area_vendor_desc'] | percentage }}</td>
                    <td>@{{ params['Sales Tax Rate']['parish_tax'] | percentage }}</td>
                    <td>@{{ params['Sales Tax Rate']['parish_vendor_desc'] | percentage }}</td>
                </tr>--}}

                <tr>
                    <td>@{{ sales_tax_rates['address']['county'] }}</td>
                    <td>@{{ sales_tax_rates['address']['city'] }}</td>
                    <td>@{{ sales_tax_rates['area']['code'] }}</td>
                    <td>@{{ sales_tax_rates['area']['tax'] | percentage }}</td>
                    <td>@{{ sales_tax_rates['area']['discount'] | percentage }}</td>
                    <td>@{{ sales_tax_rates['parish']['tax'] | percentage }}</td>
                    <td>@{{ sales_tax_rates['parish']['discount'] | percentage }}</td>
                </tr>
                </tbody>
            </table>
        </ul>
    </div>
</div>