@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="hpanel hblue">
            <div class="panel-heading hbuilt">
                <div class="panel-tools">
                    <a class="showhide">
                        <font-awesome-icon icon="chevron-up"></font-awesome-icon>
                        <!--i class="fa fa-chevron-up"></i-->
                    </a>
                    <a class="closebox">
                        <font-awesome-icon icon="times"></font-awesome-icon>
                        <!--i class="fa fa-times"></i-->
                    </a>
                </div>
                Crear Reservación
            </div>
            <div class="panel-body">
                <new-form-reservation url-save="{{ route('reservations.store') }}"></new-form-reservation>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $("input[name='quantity']").TouchSpin();
    </script>
@endpush