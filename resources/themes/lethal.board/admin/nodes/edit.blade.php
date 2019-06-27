{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', 'Index')
@section('breadcrumb', Breadcrumbs::render('/acp/nodes'))

@section('additional_scripts')
    {!! Theme::js('vendor/jquery/jquery-ui.min.js?t={cache-version}') !!}
    {!! Theme::css('vendor/jquery/jquery-ui.min.css?t={cache-version}') !!}
    {!! Theme::js('vendor/sortablejs/sortable.min.js?t={cache-version}') !!}
@endsection

@section('content')

    <script>
        $(document).ready(function () {
            Sortable.create(sortable_nodes, {
            });
            for (var i = 0; i < forums_node.length; i++) {
                new Sortable(forums_node[i], {
                    group: 'nested',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65
                });
            }
            function pushOrder() {
                const nestedQuery = '.nested-sortable';
                const identifier = 'orderValue';
                const root = document.getElementById('sortable_nodes');
                function serialize(sortable) {
                    var serialized = [];
                    var children = [].slice.call(sortable.children);
                    for (var i in children) {
                        var nested = children[i].querySelector(nestedQuery);
                        serialized.push({
                            id: children[i].dataset[identifier],
                            children: nested ? serialize(nested) : []
                        });
                    }
                    return serialized
                }

                var obj = serialize(root);

                var result = Object.keys(obj).map(function(key) {
                    return [Number(key), obj[key]];
                });

                console.log(result);

                $.ajax({
                    type: "POST",
                    url: '/acp/nodes/save',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                    data: {result},

                });

            }
            document.getElementById('save_button').onclick = pushOrder;
        });


    </script>

<div class="card box-shadow box-outline box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
    <div class="card-header">
        Nodes
        <span class="float-right">
            <a href="/category/create" class="btn btn-sm btn-warning"><i class="fas fa-plus fa-fw"></i> Add Category</a>
            <a href="/forum/create" class="btn btn-sm btn-warning"><i class="fas fa-plus fa-fw"></i> Add Forum</a>
            <button id="save_button" class="btn btn-sm btn-success"><i class="fas fa-save fa-fw"></i> Save</button>
        </span>
    </div>
    <div class="card-body">


        <ol id="sortable_nodes" class="list-group">

        @if(count($categories) > 0)
            @foreach($categories as $category)
                @if(strcmp($category->type, 'category') == 0)

                    <!-- CATEGORY -->
                    <li id="category_node" class="list-group-item box-shadow nested-sortable" data-order-value="c-{{$category->id}}">
                        <P>
                            <span class="node-title">
                                <i class="fas fa-bars fa-fw"></i>
                                {{$category->name}}
                            </span>
                            <span class="float-right">
                                <a href="" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit fa-fw"></i> Edit</a>
                                <a href="" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt fa-fw"></i></a>
                            </span>
                        </P>
                        <ol id="forums_node" class="list-group nested-sortable">
                        @if(count($forums) > 0)
                            @foreach($forums as $forum)
                                @if(strcmp($forum->category, $category->id) == 0)

                            <!-- FORUM -->
                            <li id="forum_node" class="list-group-item nested-sortable" data-order-value="f-{{$forum->id}}">
                                <span class="node-title">
                                    <i class="fas fa-comments fa-fw"></i>
                                    {{$forum->name}}
                                </span>
                                        <span class="float-right">
                                    <a href="" class="btn btn-sm btn-outline-success"><i class="fas fa-edit fa-fw"></i> Edit</a>
                                    <a href="" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt fa-fw"></i></a>
                                </span>
                            </li>
                            <!-- /FORUM -->
                                @endif
                            @endforeach
                        @endif
                        </ol>
                    </li>
                    <!-- /CATEGORY -->
                    @elseif(strcmp($category->type, 'link') == 0)
                    <!-- LINK -->
                    <li id="link_node" class="list-group-item box-shadow nested-sortable" data-order-value="c-{{$category->id}}">
                        <span class="node-title">
                            <i class="fas fa-link fa-fw"></i>
                            {{$category->name}}
                        </span>
                        <span class="float-right">
                            <a href="" class="btn btn-sm btn-outline-success"><i class="fas fa-edit fa-fw"></i> Edit</a>
                            <a href="" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt fa-fw"></i></a>
                        </span>
                    </li>
                    <!-- /LINK -->
                @endif
            @endforeach
        @endif
        </ol>



    </div>

</div>

@endsection
