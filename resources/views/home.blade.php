@extends('layouts.master')

@section('content')
<div class="row mb-3">
    <div class="col-lg-12">
        <section class="cta-section bg-ordena py-5 text-dark">
            <div class="container text-center">
                <h2 class="heading">Inicio de administracion</h2>
                <div class="intro">Puedes ver los resumenes de la empresa</div>

            </div>
            <!--//container-->
        </section>
    </div>
</div>

<div class="row">
    @can ('almacenes.index')
    <div class="col-md-2 col-sm-6 ">
        <ul class="list-group">
            @foreach ($almacenes as $almacen)

            <li class="list-group-item"><a href="{{route('almacenes.show', $almacen->id)}}">{{$almacen->nombre}}</a>
            </li>

            @endforeach
        </ul>
    </div>
    @endcan

    @can ('productos.index')
    @can ('clientes.index')
    @can ('user.index')
    <div class="col-md-3 col-sm-12 m-2">
        <div class="card card-stats">
            {!! $chart->container() !!}
        </div>
    </div>
    @endcan
    @endcan
    @endcan

    @can ('productos.index')

    <div class="col-md-3 col-sm-12 m-2 ">
        <div class="card card-stats">
            {!! $productos->container() !!}
        </div>
    </div>

    @endcan
    @can ('almacenes.index')

    <div class="col-md-3 col-sm-12 m-2 ">
        <div class="card card-stats">
            {!! $productosAlmacen->container() !!}
        </div>
    </div>

    @endcan



</div>
<div class="row m-2">

</div>
{!! $chart->script() !!}
{!! $productos->script() !!}
{!! $productosAlmacen->script() !!}


@endsection
