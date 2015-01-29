<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <h1>
        <a href="{{ url }}/create" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only" translate>New</span></a>
        <span translate translate-n="models.length" translate-plural="{{ models.length }} categories">{{ models.length }} category</span>
    </h1>

    <div class="btn-toolbar" role="toolbar" ng-include="'/views/partials/btnLocales.html'"></div>

    <ul class="nested">
	    <li ng-repeat="model in displayedModels" ng-include="'nested_model_renderer'"></li>
	</ul>

    <script type="text/ng-template"  id="nested_model_renderer">
    <div><typi-btn-delete ng-click="delete(model)"></typi-btn-delete>
    <span typi-btn-edit></span> <span typi-btn-status></span>
    <input class="form-control inline-sm input-sm" min="1" type="number" value="{{ model.position }}" name="position" ng-model="model.position" ng-change="update(model)">
     {{model.title}} 
    </div>
    <ul>
        <li ng-repeat="model in model.items" ng-include="'nested_model_renderer'"></li>
    </ul>
</script>

</div>
