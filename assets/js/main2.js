import { TableService } from "./app/TableService.js";

const tabla = new TableService();

const tables = await tabla.getAllTables();

console.log(tables);