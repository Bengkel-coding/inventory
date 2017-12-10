
<?php
    $search = function($eachId,$return,$else="",$status=""){
        $menu = trinata::getMenu();

        if($status == 'child')
        {
            $id = $menu->id;

        }else{
            if($menu->parent_id != null)
            {
                $id =  $menu->parent_id;
            }else{
                $id = $menu->id;
            }
        }
               

        return $eachId == $id ? $return : $else;
    };
?>

<div class="wg_base_module_navigation" id="main" >
    <ul id="list_container">

        @foreach(injectModel('Menu')->whereParentId(null)->orderBy('order','asc')->get() as $row)

            <li class="root {{ $search($row->id,'hover') }}">
                <a class="{{ $row->slug }}" onclick = "openChild('{{ $row->id }}')" href="{{ ($row->controller != '#' ? urlBackend($row->slug.'/index') : '#') }}"><span>{{ $row->title }}</span></a>
            </li>

        @endforeach
       
       
    </ul>
    </div>
</div>
<div id="navigation-slick-children">
     @foreach(injectModel('Menu')->whereParentId(null)->get() as $parent)
        <ul class="child" id = 'child{{ $parent->id }}' onclick = '' style = 'margin-top:5px;display:{{ $search($parent->id,"block","none") }};'>

            @foreach($parent->childs as $child)
                <li>
                    <a style = 'margin-right:15px;{{ $search($child->id,"color:green;","","child") }}' href="{{ urlBackend($child->slug.'/index') }}">{{ $child->title }}</a>
                </li>
            @endforeach

        </ul>

     @endforeach

        
    <div id="snbp">&lt;</div>
    <div id="snbn">&gt;</div>
</div>