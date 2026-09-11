@props(['platillo'])

<div class="card shadow-sm mb-3 rounded border-0">
    <div class="card-body">
        <h5 class="card-title text-primary fw-bold">{{ $platillo['nombre'] ?? $platillo->nombre }}</h5>
        <p class="card-text text-muted">{{ $platillo['descripcion'] ?? $platillo->descripcion }}</p>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="fs-5 fw-bold text-success">${{ number_format($platillo['precio'] ?? $platillo->precio, 2) }}</span>
            <button class="btn btn-sm btn-outline-primary">Agregar al carrito</button>
        </div>
    </div>
</div>