<table class="table table-border table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Nit</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Habilitado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->nit }}</td>
        <td>{{ $user->name .' '. $user->surname }}</td>
        <td>{{ $user->email }}</td>
        @if($user->active)
        <td class="bg-success text-white text-center border border-white rounded">Si</td>
        @else
        <td class="bg-danger text-white text-center border border-white rounded">No</td>
        @endif
        <td>
            <a href="{{ route('admin.product.change-state', ['id' => $user->id, 'search' => $search] )  }}" class="btn btn-primary col-7">
                {{$user->active ? 'Deshabilitar' : 'Habilitar' }}
            </a>
            <a href="{{ route('user.edit',$user->id) }}" class="btn btn-warning ml-2">
                <i class="fa fa-pencil"></i> Editar
            </a>
        </td>
    </tr>
    @endforeach
</table>