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

<div class="checkpoint-modal" ng-if="params.modals.rates" ng-cloak ng-model="params.modals.rates" modal>
    <div class="checkpoint-modal-inner">
        <a class="close" href="#"><i class="fa fa-times-circle"></i></a>
        <label>Tax Rates Information</label>
        <ul>
            <table id="data-one-options">
                <thead>
                <tr>
                    <th>Juris Type</th>
                    <th>Juris Code</th>
                    <th>Juris Name</th>
                    <th>Juris Rate</th>
                </tr>
                </thead>
                <tbody>

                <tr ng-repeat="(key, value) in params['Sales Tax Rate']">
                    <td>@{{ value['JurisType'] }}</td>
                    <td>@{{ value['JurisCode'] }}</td>
                    <td>@{{ value['JurisName'] }}</td>
                    <td>@{{ value['Rate'] | percentage }}</td>
                </tr>
                </tbody>
            </table>
        </ul>
    </div>
</div>