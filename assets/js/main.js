
import { TableService } from './app/TableService.js';

/**
 * Clase principal de la aplicación
 */
class TesaliaEnergyApp {
    constructor() {
        this.tableService = new TableService();
        this.init();
    }

    async init() {
        try {
            // Obtener y mostrar las tablas al cargar la página
            const tables = await this.tableService.getAllTables();
            this.displayTables(tables);
        } catch (error) {
            this.showError('Error al cargar las tablas', error);
        }
    }

    /**
     * Muestra las tablas en la interfaz
     * @param {Array<string>} tables 
     */
    displayTables(tables) {
        const container = document.getElementById('tables-container');
        if (!container) return;

        container.innerHTML = `
            <h2>Tablas de Medidores</h2>
            <ul class="table-list">
                ${tables.map(table => `
                    <li class="table-item" data-table="${table}">
                        ${table}
                        <button class="btn-show-data" data-table="${table}">
                            Mostrar datos
                        </button>
                    </li>
                `).join('')}
            </ul>
        `;

        // Agregar event listeners
        document.querySelectorAll('.btn-show-data').forEach(button => {
            button.addEventListener('click', (e) => {
                const tableName = e.target.dataset.table;
                this.loadTableData(tableName);
            });
        });
    }

    /**
     * Carga los datos de una tabla específica
     * @param {string} tableName 
     */
    async loadTableData(tableName) {
        try {
            console.log(`Cargando datos de: ${tableName}`);
            const data = await this.tableService.getTableData(tableName);
            console.log('Datos recibidos:', data);
            
            // Aquí procesarías los datos para mostrar
            this.displayTableData(tableName, data);
        } catch (error) {
            this.showError(`Error al cargar datos de ${tableName}`, error);
        }
    }

    /**
     * Muestra los datos de una tabla
     * @param {string} tableName 
     * @param {Array} data 
     */
    displayTableData(tableName, data) {
        // Implementar según tus necesidades
        alert(`Datos de ${tableName} recibidos (consola para detalles)`);
    }

    /**
     * Maneja errores de la aplicación
     * @param {string} message 
     * @param {Error} error 
     */
    showError(message, error) {
        console.error(`${message}:`, error);
        // Aquí podrías mostrar una notificación al usuario
        alert(`${message}. Ver consola para detalles.`);
    }
}

// Iniciar la aplicación cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new TesaliaEnergyApp();
});

