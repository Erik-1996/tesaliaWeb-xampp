
import { ApiClient } from './ApiClient.js';
/**
 * Servicio para manejar operaciones con tablas
 */
export class TableService extends ApiClient {
    constructor() {
        super(); // Hereda la URL base de ApiClient
    }

    /**
     * Obtiene todas las tablas de medidores
     * @returns {Promise<Array<string>>}
     */
    async getAllTables() {
        try {
            const response = await this.get('tables.php', {
                action: 'get_all'
            });

            if (response.status !== 'success') {
                throw new Error(response.message || 'Error al obtener tablas');
            }

            return response.data;
        } catch (error) {
            return this.handleApiError(error);
        }
    }

    /**
     * Obtiene los datos de una tabla específica
     * @param {string} tableName 
     * @param {Object} filters 
     * @returns {Promise<Array>}
     */
    async getTableData(tableName, filters = {}) {
        try {
            const response = await this.get('data.php', {
                table: tableName,
                ...filters
            });

            if (response.status !== 'success') {
                throw new Error(response.message || 'Error al obtener datos');
            }

            return response.data;
        } catch (error) {
            return this.handleApiError(error);
        }
    }
}