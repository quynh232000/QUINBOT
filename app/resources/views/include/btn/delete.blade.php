<a onclick="handleConfirmDelete({{isset($tblDel) ? $tblDel : 0}},'{{route($params['prefix'] . '.' . $params['controller'] . '.confirm-delete')}}')"

    class="btn btn-danger " data-toggle="tooltip" data-placement="top"
    data-original-title="{{isset($title) ? $title : 'Delete'}}">
    <i class="fa-sharp fa-solid ki-outline ki-trash m-0 text-white pr-0">&nbsp;&nbsp;</i>
    {{isset($title) ? $title : 'Delete'}}
</a>
