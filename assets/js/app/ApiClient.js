/**
 * Clase base para manejar peticiones HTTP
 */
export class ApiClient {
    constructor(baseUrl = 'http://10.10.23.25/tesaliaWeb-xampp/public/api/') {
        this.baseUrl = baseUrl;
    }

    /**
     * Realiza una petición GET
     * @param {string} endpoint 
     * @param {Object} params 
     * @returns {Promise<Object>}
     */
    async get(endpoint, params = {}) {
        const url = new URL(endpoint, this.baseUrl);
        
        // Agregar parámetros a la URL
        Object.entries(params).forEach(([key, value]) => {
            if (value !== undefined && value !== null) {
                url.searchParams.append(key, value);
            }
        });

        const response = await fetch(url.toString(), {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return response.json();
    }

    /**
     * Maneja errores de la API
     * @param {Error} error 
     */
    handleApiError(error) {
        console.error('API Error:', error);
        // Aquí puedes agregar notificaciones al usuario
        throw error; // Relanzamos para manejo adicional
    }
}