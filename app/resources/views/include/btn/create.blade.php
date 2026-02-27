<a href="{{route($params['prefix'] . '.' . $params['controller']  . '.' . (isset($action) ? $action : 'create'))}}"
class="btn btn-primary {{(isset($class) ? $class : 'create')}}"
    data-toggle="tooltip" data-placement="top" data-original-title="{{isset($title) ? $title :'Add new'}}">
    <i class="ki-outline ki-plus fs-2  lh-0 {{isset($icon) ? $icon : 'fa-plus'}}">&nbsp;</i>{{isset($title) ? $title :'Add new'}}
</a>
