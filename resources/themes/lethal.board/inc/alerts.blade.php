{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@if(session('errors'))
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
@endif

@if(session('success'))
    <div class="alert alert-success animated pulse text-center">
        <h4 class="alert-heading">Success!</h4>
        <p>
        {{session('success')}}
        </p>
    </div>

    <script>
        $( document ).ready(function() {
            setTimeout(function () {

                $(".alert").addClass('flipOutX');
                $(".alert").slideUp(500);

            },4000);

            setTimeout(function () {
                $(".alert").alert('close');
            },4800);
        });
    </script>

@endif

@if(session('success-confirm'))
    <script>
        $( document ).ready(function() {
            Swal.fire({
                type: 'success',
                title: 'Success!',
                text: '{{session('success')}}'
            })
        });
    </script>
@endif

@if(session('error'))
    <div class="alert alert-danger animated flipInX text-center">
        <h4 class="alert-heading">Oops!</h4>
        <p>
        {{session('error')}}
        </p>
    </div>

    <script>
        $( document ).ready(function() {
            setTimeout(function () {
                $(".alert").slideUp(500,function () {
                    $(".alert").addClass('flipOutX');
                });
            },4000);

            setTimeout(function () {
               // $(".alert").alert('close');
            },4800);
        });
    </script>
@endif

@if(session('error-confirm'))
    <script>
        $( document ).ready(function() {
        Swal.fire({
        type: 'error',
        title: 'Oops!',
        text: '{{session('error-confirm')}}'
        })
        });
    </script>
@endif
