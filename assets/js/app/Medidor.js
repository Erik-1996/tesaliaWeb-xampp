class Medidor {
    constructor(id, nombre, ubicacion) {
        this.id = id;
        this.nombre = nombre;
        this.ubicacion = ubicacion;
    }
    
    obtenerDatos(fechaInicio, fechaFin) {
        // Lógica para obtener datos del medidor
    }
    
    renderTarjeta() {
        return `
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">${this.nombre}</h5>
                        <p class="card-text">${this.ubicacion}</p>
                        <a href="medidores/detalle.php?id=${this.id}" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
        `;
    }
}