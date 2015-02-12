<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <h1>
        <a href="{{ url }}/create" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only" translate>New</span></a>
        <span translate translate-n="models.length" translate-plural="{{ models.length }} users">{{ models.length }} user</span>
    </h1>

    <div class="btn-toolbar" role="toolbar" ng-include="'/views/partials/btnLocales.html'"></div>

    <div class="table-responsive">

        <table st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="first_name" class="first_name st-sort" translate>First name</th>
                    <th st-sort="last_name" class="last_name st-sort" translate>Last name</th>
                    <th st-sort="email" class="email st-sort" translate>Email</th>
                    <th st-sort="activated" class="activated st-sort" translate>Activated</th>
                    <th st-sort="superuser" class="superuser st-sort" translate>Superuser</th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3">
                        <input st-search class="form-control input-sm" placeholder="{{ 'Search' | translate }}…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td><typi-btn-delete ng-click="delete(model, model.first_name + ' ' + model.last_name)"></typi-btn-delete></td>
                    <td typi-btn-edit></td>
                    <td>{{ model.first_name }}</td>
                    <td>{{ model.last_name }}</td>
                    <td>{{ model.email }}</td>
                    <td>{{ model.activated }}</td>
                    <td>{{ model.permissions.superuser }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>
