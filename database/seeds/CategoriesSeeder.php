<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // categorias vigentes
        $categories = [
            ['1', 'POLÍTICA DE SEGURIDAD DE LA INFORMACIÓN',   null],
            ['2', 'ORGANIZACIÓN DE LA SEGURIDAD DE LA INFORMACIÓN',  null],
            ['3', 'GESTIÓN DE LOS ACTIVOS', null],
            ['4', 'SEGURIDAD DE LOS RECURSOS HUMANOS', null],
            ['5', 'SEGURIDAD FÍSICA Y DEL ENTORNO', null],
            ['6', 'GESTIÓN DE COMUNICACIONES Y OPERACIONES', null],
            ['7', 'CONTROL DE ACCESO', null],
            ['8', 'ADQUISICIÓN, DESARROLLO, Y MANTENIMIENTO DE SISTEMAS DE INFORMACIÓN',  null],
            ['9', 'GESTIÓN DE LOS INCIDENTES DE LA SEGURIDAD DE LA INFORMACIÓN',  null],
            ['1.1', 'Documento de la Política de la Seguridad de la Información',  '1'],
            ['2.1', 'Compromiso de la máxima autoridad de la institución con la seguridad de la información realizada',  '2'],
            ['2.2', 'Coordinación de la Gestión de la Seguridad de la Información',  '2'],
            ['2.5', 'Acuerdos sobre Confidencialidad ',  '2'],
            ['3.1', 'Inventario de activos',  '3'],
            ['3.3', 'Uso aceptable de los activos',  '3'],
            ['3.4', 'Directrices de clasificación de la información',  '3'],
            ['4.1', 'Funciones y responsabilidades',  '4'],
            ['4.4', 'Responsabilidades de la dirección a cargo del funcionario ',  '4'],
            ['5.1', 'Perímetro de la seguridad física',  '5'],
            ['5.2', 'Controles de acceso físico',  '5'],
            ['5.3', 'Seguridad de oficinas, recintos e instalaciones',  '5'],
            ['5.4', 'Protección contra amenazas externas y ambientales',  '5'],
            ['5.5', 'Trabajo en áreas seguras',  '5'],
            ['5.6', 'Áreas de carga, despacho y acceso público',  '5'],
            ['5.7', 'Ubicación y protección de los equipos',  '5'],
            ['5.8', 'Servicios de suministro', '5'],
            ['5.9', 'Seguridad del cableado', '5'],
            ['6.1', 'Documentación de los procedimientos de Operación', '6'],
            ['6.6', 'Monitoreo y revisión de los servicios, por terceros.', '6'],
            ['6.8', 'Gestión de la capacidad', '6'],
            ['6.10', 'Controles contra código malicioso', '6'],
            ['6.12', 'Establecer controles criptográficos para autenticar de forma única el código móvil.', '6'],
            ['6.14', 'Seguridad de los servicios de la red', '6'],
            ['6.26', 'Registros de auditorías', '6'],
            ['6.27', '6.27', '6'],
            ['6.29', 'Registros del administrador y del operador', '6'],
            ['6.30', 'Registro de fallas', '6'],
            ['7.4', 'Gestión de contraseñas para usuarios',  '7'],
            ['7.6', 'Uso de contraseñas',  '7'],
            ['7.7', 'Equipo de usuario desatendido',  '7'],
            ['7.8', 'Política de puesto de trabajo despejado y pantalla limpia',  '7'],
            ['7.1', 'Autenticación de usuarios para conexiones externas',  '7'],
            ['7.11', 'Identificación de los equipos en las redes',  '7'],
            ['7.12', 'Compromiso de la máxima autoridad de la institución con la seguridad de la información realizada',  '7'],
            ['7.13', 'Separación en las redes',  '7'],
            ['7.15', 'Control del enrutamiento en la red ',  '7'],
            ['7.16', 'Procedimiento de registro de inicio seguro ',  '7'],
            ['7.17', 'Identificación y autenticación de usuarios',  '7'],
            ['7.18', 'Sistema de gestión de contraseñas',  '7'],
            ['7.25', 'Computación y comunicaciones móviles',  '7'],
            ['7.26', 'Trabajo remoto',  '7'],
            ['8.1', 'Análisis y especificaciones de los requerimientos de seguridad',  '8'],
            ['9.1', 'Reporte sobre los eventos de seguridad de la información',  '9'],
        ];

        foreach ($categories as $elem) {
            $category = new Category();
            $category->number = $elem[0];
            $category->name = $elem[1];
            $category->parent_number = $elem[2];

            $category->save();
        }

    }
}
