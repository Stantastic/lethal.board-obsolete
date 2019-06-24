{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', 'Index')
@section('breadcrumb', Breadcrumbs::render('index'))

@section('additional_scripts')
    {!! Theme::js('vendor/jquery/jquery-ui.min.js?t={cache-version}') !!}
    {!! Theme::css('vendor/jquery/jquery-ui.min.css?t={cache-version}') !!}
    {!! Theme::js('vendor/sortablejs/sortable.min.js?t={cache-version}') !!}
@endsection

@section('content')

<div class="card box-shadow box-outline box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
    <div class="card-header">Nodes</div>
    <div class="card-body">


        <ul class="sortable_nodes">
            <li class="category_node">CATEGORY
                <ul class="forums_node">
                    <li class="forum_node">FORUM</li>
                    <li class="forum_node">FORUM</li>
                </ul>
            </li>
            <li class="link_node">LINK
            </li>
            <li class="category_node">CATEGORY
                <ul class="forums_node">
                    <li class="forum_node">FORUM</li>
                </ul>
            </li>
        </ul>



    </div>

</div>
    <script>

        $(document).ready(function () {
            $("ul.sortable_nodes").sortable({
                axis: 'y',
                connectWith:'.forums_node',
                placeholder: "ui-state-highlight",
                forcePlaceholderSize: true,
                swapThreshold: 1,
                // to intercept a movement
                stop: function(event, ui) {
                    if (ui.item.children('category_node').length
                        && !ui.item.parent('category_node').length)
                    {
                        $(this).sortable('cancel');
                    }
                }
            });
            $("ul.sortable_nodes").disableSelection();

            $("ul.forums_node").sortable({
                axis: 'y',
                connectWith:'.forums_node',
                placeholder: "ui-state-highlight",
                forcePlaceholderSize: true,
                swapThreshold: 1
            });
            $("ul.forums_node").disableSelection();
        });


    </script>
@endsection
