<button id="save-primary" {{isset($id)?'id='.$id.'':''}}  class="@if(isset($classes)) {{$classes}} @else btn btn-primary  @endif" type="submit">
    <i class="fa-sharp fa-solid fa-floppy-disk"></i> Save
</button>
