@php
$dimmerGroups = Voyager::dimmers();
@endphp

@forelse($dimmerGroups as $dimmerGroup)
    @php
    $count = $dimmerGroup->count();
    $classes = [
        'col-xs-12',
        'col-sm-'.($count >= 2 ? '6' : '12'),
        'col-md-'.($count >= 3 ? '4' : ($count >= 2 ? '6' : '12')),
    ];
    $class = implode(' ', $classes);
    $prefix = "<div class='{$class}' style='padding-left:0px; padding-right:0px'>";
    $surfix = '</div>';
    @endphp
    @if ($dimmerGroup->any())
    <div class="clearfix container-fluid row" style=" padding-left: 0px; ">
        {!! $prefix.$dimmerGroup->setSeparator($surfix.$prefix)->display().$surfix !!}
    </div>
    @endif

@empty

@endforelse
