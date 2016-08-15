<style>
    #data-one-options {
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }

    #data-one-options td, th {
        text-align: center;
    }

    .checkpoint-modal-inner {
        width: 1000px!important;
    }

    #log-div {
        overflow: auto;
        height: 500px!important;
    }
</style>


<div class="checkpoint-modal" ng-if="logs.modal" ng-model="logs.modal" ng-cloak modal>
    <div class="checkpoint-modal-inner">
        <a class="close" href="#"><i class="fa fa-times-circle"></i></a>
        <label>Params</label>
        <div id="log-div">
            @{{ logs.modal_value }}
        </div>
    </div>
</div>